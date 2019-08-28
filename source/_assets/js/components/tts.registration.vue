<template>
        <div v-cloak>
            <div class="notification is-warning">
                Online registration opens: {{openRegistrationDate.format('MMM Do YYYY') }}.
                <br>
                Online registration closes after: {{ closeRegistrationDate.format('MMM Do YYYY [at noon]') }}.
            </div>
            <div class="notification is-danger" v-if="(isBeforeRegistrationIsOpen)">
                Online registration is not yet open. Check back after {{ openRegistrationDate.format('MMM Do YYYY')
                }}.
            </div>
            <div class="notification is-danger" v-if="(isAfterRegistrationIsClosed)">
                Online registration is now closed. See you on the dance floor.
            </div>

            <form @submit.prevent="processRegistration()">
                <button type="submit"
                        v-if="(registrationIsOpen && !$v.registrations.$invalid)"
                        class="button is-info">Ready to pay with PayPal
                </button>
                <button type="button"
                        v-if="(!registrationIsOpen || $v.registrations.$invalid)"
                        class="button is-danger">Not Ready to pay
                </button>


                <div class="message is-success">
                    <div class="message-body total-cost ">
                        Total: $ <span class="total-amount">{{ totalCost }}</span>
                    </div>
                </div>


                <div class="box" v-for="(reg, index) in $v.registrations.$each.$iter" :key="reg.$model.id">

                        <span class="icon is-small is-pulled-left is-danger destroy"
                              v-if="registrations.length > 1 && reg.$model.id > 0"
                              @click="removeReg(reg)"
                              title="Remove registration">
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
                                    <input class="input " :class="{invalid: reg.name.$invalid }"
                                           type="text"
                                           placeholder="Full Name"
                                           v-model.trim="reg.name.$model"
                                    >
                                    <span class="icon is-small is-left"><i class="fas fa-user"></i>
                                        </span>
                                </p>
                                <div class="invalid" v-if="reg.name.$error">A full name is required.</div>
                            </div>
                            <div class="field">
                                <p class="control  has-icons-left ">
                                    <input class="input" :class="{invalid: reg.email.$invalid }"
                                           type="email"
                                           placeholder="Email"
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

                    <div class="field is-horizontal">
                        <div class="field-label">
                            <label class="label"></label>
                        </div>
                        <div class="field-body">
                            <div class="field ">
                                <div class="control">
                                    <label class="checkbox">
                                        <input type="checkbox"
                                               name="member"
                                               class="cost"
                                               v-model="reg.$model.member">
                                        Member Dance Org - AACTMAD or other |
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox"
                                               name="under25"
                                               class="cost"
                                               v-model="reg.$model.under25">
                                        25 or under
                                    </label>
                                </div>
                            </div>
                            <div class="message is-success">
                                <div class="message-body total-cost ">
                                    Subtotal: $ <span class="total-amount">{{ reg.$model.regCost() }}</span>
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
                                    <input class="input" type="text" name="phone" style="width: 10em"
                                           placeholder="Phone Number"
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
                                    <input class="input" type="text" name="street"
                                           placeholder="Street Address"
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
                                    <input class="input" type="text" name="city" v-model="reg.$model.city">
                                </p>
                            </div>
                            <div class="field-label">
                                <label class="label">State/Prov</label>
                            </div>
                            <div class="control">
                                <p class="control is-expanded ">
                                    <input class="input" type="text" name="state" v-model="reg.$model.state">
                                </p>
                            </div>
                            <div class="field-label">
                                <label class="label">Zip/Postal</label>
                            </div>
                            <div class="control">
                                <p class="control is-expanded ">
                                    <input class="input" type="text" name="zip" v-model="reg.$model.zip">
                                </p>
                            </div>
                        </div>
                    </div>


                </div>
            </form>


            <input class='button is-info' type="submit" value="Add another registration..."
                   @click.prevent="addReg">

            <div class="hidden">
                <form id="paypalForm" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                    <input type="hidden" name="item_name" value="Tree Town Stomp 2019 Registration"/>
                    <input type="hidden" name="return" value="https://aactmad.org/tts"/>
                    <input type="hidden" name="cancel_return" value="https://aactmad.org/tts"/>
                    <input type="hidden" name="notify_url" value="https://assets.aactmad.org/paypal/ipn.php" />

                    <input type="hidden" name="cmd" value="_xclick">
                    <input type="hidden" id="amount" name="amount" value="10">
                    <input type="hidden" id="item_number" name="item_number" value="123456"/>
                    <input type="hidden" name="business" value="paypal@aactmad.org"/>
                    <input type="hidden" name="rm" value="2"/>
                    <input type="hidden" name="currency_code" value="USD">
                    <input type="submit" value="Pay with PayPal"/>
                </form>
            </div>


        </div>


</template>

<script type="module">
    import axios from 'axios';
    import moment from 'moment';
    const findIndex = require('lodash.findindex');
    const {required, minLength, email} = require('vuelidate/lib/validators')

    const MEMBER = 75;
    const NONMEMBER = 80;
    const UNDER25 = 50;
    const YEAR = 2019;
    const DATES = 'October 25-27';

    class Registration {
        constructor() {
            this.id = 0;
            this.name = '';
            this.email = '';
            this.member = false;
            this.under25 = false;
            this.street = '';
            this.city = '';
            this.state = '';
            this.zip = '';
            this.phone = '';
            this.total = 0;
            this.regCost = function () {
                this.total = (this.under25 ? UNDER25 : (this.member ? MEMBER : NONMEMBER));
                return this.total;
            };
            this.setId = function (lid) {
                this.id = lid;
            }
        }
    }

    export default {
        name: "tts-registration",
        data() {
            return {
                openRegistrationDate: moment('2019-05-01', 'YYYY-MM-DD'),
                closeRegistrationDate: moment('2019-10-25 12', 'YYYY-MM-DD k'),
                isBeforeRegistrationIsOpen: false,
                isAfterRegistrationIsClosed: false,
                uid: 0,
                total: 0,
                registrations: [],
                year: YEAR,
                dates: DATES,
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
                    }
                }
            },
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
        },
        computed: {
            registrationIsOpen() {
                return !(this.isBeforeRegistrationIsOpen || this.isAfterRegistrationIsClosed);
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
                    logfile: 'tts.registrations.txt',
                    message: this.assembleMessage(),
                };
                let headers = {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'};
                return axios.post('https://assets.aactmad.org/logger.php', log, {headers: headers});
            },
            doMailToDancer() {
                let headers = {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'};
                return axios.post('/php/tts.email.php', this.assembleMessage(), {headers: headers});
            },
            submitToPayPal() {
                let paypalForm = document.getElementById('paypalForm');

                paypalForm.submit();
            },
            processRegistration() {
                if (!confirm("Proceed to PayPal?"))
                    return;

                this.itemNumber = moment().valueOf();

                let amount_field = document.getElementById('amount');
                amount_field.value = this.total;
                let item_number_field = document.getElementById('item_number');
                item_number_field.value = this.itemNumber;

                let log = this.doLogging();
                let mail = this.doMailToDancer();

                Promise.all([log, mail])
                    .then(() => this.submitToPayPal())
                    .catch(error => {
                        console.log(error.message)
                    });
            },
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

    /*.total-cost {*/
    /*position: fixed;*/
    /*bottom: 40%;*/
    /*right: 10px;*/
    /*transform: translateY(-50%);*/
    /*opacity: 0.90;*/
    /*}*/

</style>
