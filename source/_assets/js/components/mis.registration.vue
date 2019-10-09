<template>
    <div v-cloak>
        <div class="notification is-warning">
            Online registration opens: {{openRegistrationDate.format('MMM Do YYYY') }}. <br> Online registration closes
            after: {{ closeRegistrationDate.format('MMM Do YYYY') }}. <br> Dinner reservations are closed after: {{
            closeDinnerDate.format('MMM Do YYYY') }}.
        </div>
        <div class="notification is-danger" v-if="(isBeforeRegistrationIsOpen)">
            Online registration is not yet open. Check back after {{ openRegistrationDate.format('MMM Do YYYY') }}.
        </div>
        <div class="notification is-danger" v-if="(isAfterRegistrationIsClosed)">
            Online registration is now closed. See you on the dance floor.
        </div>

        <form @submit.prevent="processRegistration()">
            <button class="button is-info"
                    type="submit"
                    v-if="(registrationIsOpen && !$v.$invalid)">Ready to pay with PayPal
            </button>
            <button class="button is-danger"
                    type="button"
                    v-if="(!registrationIsOpen || $v.$invalid)">Not Ready to pay
            </button>

            <div class="message is-success">
                <div class="message-body total-cost ">
                    Total: $ <span class="total-amount">{{ totalCost | toCurrency }}</span>
                </div>

                <div class="invalid" v-if="$v.total.$invalid">Total can not be zero.</div>
            </div>

            <div :key="reg.$model.id" class="box" v-for="(reg, index) in $v.registrations.$each.$iter">

                        <span @click="removeReg(reg)"
                              class="icon is-small is-pulled-left is-danger destroy"
                              title="Remove registration"
                              v-if="registrations.length > 1 && reg.$model.id > 0">
                            <i class="far fa-trash-alt"></i>
                        </span>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">Name/Email</label>
                        <p class="is-italic invalid">required</p>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control  has-icons-left">
                                <input :class="{invalid: reg.name.$invalid }" class="input "
                                       placeholder="Full Name"
                                       type="text"
                                       v-model.trim="reg.name.$model"
                                >
                                <span class="icon is-small is-left"><i class="fas fa-user"></i>
                                        </span>
                            </p>
                            <div class="invalid" v-if="reg.name.$error">A full name is required.</div>
                        </div>
                        <div class="field">
                            <p class="control  has-icons-left ">
                                <input :class="{invalid: reg.email.$invalid }" class="input"
                                       placeholder="Email"
                                       type="email"
                                       v-model.trim="reg.email.$model"
                                >
                                <span class="icon is-small is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                            </p>
                            <div class="invalid" v-if="reg.email.$error">A valid email is required.</div>
                        </div>
                    </div>
                </div>
                <div class="message is-success is-pulled-right">
                    <div class="message-body total-cost ">
                        Subtotal: $ <span class="total-amount">{{ reg.$model.regCost() | toCurrency }}</span>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label"></label>
                    </div>
                    <div class="field-body">
                        <div class="field ">
                            <div class="control">
                                <label class="checkbox">
                                    <input class="cost"
                                           name="student"
                                           type="checkbox"
                                           v-model="reg.$model.student">
                                    Student |
                                </label>
                                <label class="checkbox">
                                    <input class="cost"
                                           name="weekend-full"
                                           type="checkbox"
                                           v-model="reg.$model.weekendDancing">
                                    Full Weekend, dancing |
                                </label>
                                <label class="checkbox">
                                    <input :disabled="dinnerIsClosed"
                                           class="cost"
                                           name="dinner"
                                           type="checkbox"
                                           v-model="reg.$model.dinner">
                                    Dinner
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label"></label>
                    </div>
                    <div class="field-body">
                        <div class="field ">
                            <div class="control">
                                <label class="checkbox">
                                    <input
                                           class="cost"
                                           name="Friday"
                                           type="checkbox"
                                           v-model="reg.$model.friday">
                                    Friday Dancing |
                                </label>
                                <label class="checkbox">
                                    <input class="cost"
                                           name="Saturday"
                                           type="checkbox"
                                           v-model="reg.$model.saturday"
                                    >
                                    Saturday Dancing
                                </label>
                            </div>
                            <div class="invalid" v-if="reg.total.$invalid">Must choose some option(s).</div>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">Dinning preference</label>
                    </div>
                    <div class="field-body">
                        <div class="field ">
                            <div class="control">
                                <label class="radio">
                                    <input :disabled="!reg.$model.dinner"
                                           name="meal"
                                           type="radio"
                                           v-model="reg.$model.meal"
                                           value="Vegetarian">
                                    Vegetarian |
                                </label>
                                <label class="radio">
                                    <input :disabled="!reg.$model.dinner"
                                           name="meal"
                                           type="radio"
                                           v-model="reg.$model.meal"
                                           value="Omnivore">
                                    Omnivore
                                </label>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">Phone</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" name="phone" placeholder="Phone Number" style="width: 10em"
                                       type="text"
                                       v-model="reg.$model.phone">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">Address</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" name="street" placeholder="Street Address"
                                       type="text"
                                       v-model="reg.$model.street">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">City</label>
                    </div>
                    <div class="field-body">

                        <div class="control">
                            <p class="control is-expanded ">
                                <input class="input" name="city" type="text" v-model="reg.$model.city">
                            </p>
                        </div>
                        <div class="field-label">
                            <label class="label">State/Prov</label>
                        </div>
                        <div class="control">
                            <p class="control is-expanded ">
                                <input class="input" name="state" type="text" v-model="reg.$model.state">
                            </p>
                        </div>
                        <div class="field-label">
                            <label class="label">Zip/Postal</label>
                        </div>
                        <div class="control">
                            <p class="control is-expanded ">
                                <input class="input" name="zip" type="text" v-model="reg.$model.zip">
                            </p>
                        </div>
                    </div>
                </div>


            </div>
        </form>


        <input @click.prevent="addReg" class='button is-info' type="submit"
               value="Add another registration...">

        <div class="hidden">
            <form action="https://www.paypal.com/cgi-bin/webscr" id="paypalForm" method="post">
                <input name="cmd" type="hidden" value="_xclick">

                <input id="amount" name="amount" type="hidden" value="10">
                <input name="item_name" type="hidden" value="Melt Into Spring 2019 Registration"/>
                <input id="item_number" name="item_number" type="hidden" value="123456"/>

                <input name="business" type="hidden" value="paypal@aactmad.org"/>
                <input name="return" type="hidden" value="https://aactmad.org/melt-into-spring"/>
                <input name="cancel_return" type="hidden" value="https://aactmad.org/melt-into-spring"/>
                <input name="rm" type="hidden" value="2"/>
                <input name="currency_code" type="hidden" value="USD">
                <input type="submit" value="Pay with PayPal"/>
            </form>
        </div>


    </div>

</template>

<script>
    import axios from 'axios';
    import moment from 'moment';

    const findIndex = require('lodash.findindex');
    const {required, minLength, email, minValue} = require('vuelidate/lib/validators')

    const DINNER = 28;
    const WEEKEND = 52;
    const FRIDAY = 16;
    const SATURDAY = 38;

    const CLOSE_DINNER_DATE = moment('2020-03-19', 'YYYY-MM-DD');
    const OPEN_REGISTRATION_DATE = moment('2019-01-01', 'YYYY-MM-DD');
    const CLOSE_REGISTRATION_DATE = moment('2020-04-23', 'YYYY-MM-DD');
    const YEAR = CLOSE_REGISTRATION_DATE.year();
    const DATES = 'March 27-28';

    class Registration {
        constructor() {
            this.id = 0;
            this.name = '';
            this.email = '';
            this.dinner = !moment().isAfter(CLOSE_DINNER_DATE, 'day');
            this.weekendDancing = true;
            this.student = false;
            this.friday = false;
            this.saturday = false;
            this.street = '';
            this.city = '';
            this.state = '';
            this.zip = '';
            this.phone = '';
            this.total = 0;
            this.meal = 'Omnivore';

            this.regCost = function () {
                console.log("in regCost: " + this.id);
                let total = 0;
                let dancing = 0;
                let dinner = this.dinner ? DINNER : 0;
                if (!this.dinner) this.meal = null;
                if (this.dinner && this.meal == null) this.meal = "Omnivore";

                if (this.friday || this.saturday)
                    this.weekendDancing = false;
                if (this.friday && this.saturday) {
                    this.weekendDancing = true;
                }

                if (this.weekendDancing)
                    dancing = WEEKEND;
                else {
                    dancing += this.friday ? FRIDAY : 0;
                    dancing += this.saturday ? SATURDAY : 0;
                }
                if (this.student)
                    dancing = dancing / 2;

                this.total = dancing + dinner;
                if (this.total == 0) {
                    this.friday = this.saturday = false;
                    console.log(`total = 0 : friday=${this.friday} : sat=${this.saturday}`);
                }
                return this.total;
            };
            this.setId = function (lid) {
                this.id = lid;
            }
        }
    }

    export default {
        name: "mis-registration",
        data() {
            return {
                openRegistrationDate: OPEN_REGISTRATION_DATE,
                closeRegistrationDate: CLOSE_REGISTRATION_DATE,
                closeDinnerDate: CLOSE_DINNER_DATE,
                year: YEAR,
                dates: DATES,
                isBeforeRegistrationIsOpen: false,
                isAfterRegistrationIsClosed: false,
                isAfterDinnerIsClosed: false,
                uid: 0,
                total: 0,
                registrations: [],
                itemNumber: 0,
            }
        },
        validations: {
            registrations: {
                $each: {
                    $trackBy: 'id',
                    name: {
                        required,
                        minLength: minLength(4)
                    },
                    email: {
                        required,
                        email,
                    },
                    total: {
                        required,
                        minValue: minValue(1)
                    }
                }
            },
            total: {
                required,
                minValue: minValue(1)
            }
        },
        mounted() {
            let reg = new Registration();
            reg.setId(this.uid++);
            this.registrations.push(reg);
            let now = moment();
            if (now.isBefore(this.openRegistrationDate, 'day'))
                this.isBeforeRegistrationIsOpen = true;
            if (now.isAfter(this.closeRegistrationDate, 'day')) {
                this.isAfterRegistrationIsClosed = true;
            }
            if (now.isAfter(this.closeDinnerDate, 'day')) {
                this.isAfterDinnerIsClosed = true;
            }
        },
        computed: {
            registrationIsOpen() {
                return !(this.isBeforeRegistrationIsOpen || this.isAfterRegistrationIsClosed);
            },
            dinnerIsClosed() {
                return this.isAfterDinnerIsClosed;
            },
            totalCost: function () {
                let total = this.registrations.reduce((acc, curr) => {
                    return acc + curr.regCost();
                }, 0);
                this.total = total;
                return total;
            },
        },
        methods: {
            addReg() {
                let newReg = new Registration();
                newReg.setId(this.uid++);
                let firstReg = this.registrations[0];
                newReg.street = firstReg.street;
                newReg.city = firstReg.city;
                newReg.state = firstReg.state;
                newReg.zip = firstReg.zip;
                this.registrations.push(newReg);
            },
            removeReg(reg) {
                this.registrations.splice(findIndex(this.registrations, r => r.id == reg.$model.id), 1);
            },
            testPost() {
                this.doLogging();
                this.doMailToDancer();
            },
            assembleMessage() {
                return {
                    ItemNumber: this.itemNumber,
                    Total: this.totalCost,
                    Registrations: this.registrations,
                    Year: this.year,
                    Dates: this.dates,
                }
            },
            doLogging() {
                let log = {
                    secret: 'iamthebossofaactmad',
                    logfile: 'melt.into.spring.txt',
                    message: this.assembleMessage(),
                };
                let headers = {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'};
                return axios.post('https://assets.aactmad.org/logger.php', log, {headers: headers});
            },
            doMailToDancer() {
                let headers = {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'};
                return axios.post('/php/melt.into.spring.email.php', this.assembleMessage(), {headers: headers});
            },
            submitToPayPal() {
                let paypalForm = document.getElementById('paypalForm');
                let amount = document.getElementById('amount');
                amount.value = this.total;
                let item_number = document.getElementById('item_number');
                item_number.value = this.registrations[0].name + " " + new Date().toLocaleString();
                paypalForm.submit();
            },
            processRegistration() {
                if (!confirm("Proceed to PayPal?"))
                    return;

                this.itemNumber = this.registrations[0].name + " - " + moment().format();
                let log = this.doLogging();
                let mail = this.doMailToDancer();

                Promise.all([log, mail])
                    .then(() => this.submitToPayPal())
                    .catch(error => {
                        console.log(error.message)
                    });
            },
        },
        filters: {
            toCurrency: function (value) {
                if (typeof value !== "number") {
                    return value;
                }
                var formatter = new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD',
                    minimumFractionDigits: 2
                });
                return formatter.format(value);
            }
        }
    }

</script>

<style scoped>

    [v-cloak] {
        display: none;
    }

    .notification {
        width: fit-content;
    }

    .hidden {
        display: none;
    }

    input:invalid {
        border: 2px dashed red;
    }

    .invalid {
        color: red;
    }

    .message-body {
        font-weight: bold;
        font-size: 1.2rem;
    }

    .box .destroy {
        color: darkred;
    }

    .box .destroy:hover {
        color: red;
        cursor: pointer;
    }

    .message {
        display: inline-block;
        /*padding: 0.50rem 1rem;*/
    }

    .message-body {
        padding: 0.55rem 1rem;
    }

</style>
