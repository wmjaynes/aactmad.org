<template>
    <div v-cloak>
        <form @submit.prevent="processMembership()">
            <button type="submit" :disabled="$v.names.$invalid"
                    class="button is-info">Ready to pay with PayPal
            </button>

            <div class="box">
                <p class="notification">
                    1. List those residing at your address who are enrolling as members:
                </p>

                <div class="field is-horizontal" v-for="(name, index) in $v.names.$each.$iter">
                    <div class="field-label">
                        <label class="label">Name/Email/Phone</label>
                        <div class="field is-grouped">
                            <button class='button is-info is-small'
                                    v-if="index == 0"
                                    @click.prevent="addName">Add name
                            </button>
                            <button class='button is-info is-small'
                                    v-if="index == 0 && names.length > 1"
                                    @click.prevent="removeName">Remove name
                            </button>
                        </div>

                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control  has-icons-left">
                                <input class="input " :class="{invalid: name.name.$invalid }"
                                       type="text"
                                       placeholder="Full Name - Required"
                                       v-model.trim="name.name.$model"
                                >
                                <span class="icon is-small is-left"><i class="fas fa-user"></i>
                                        </span>
                            </p>
                            <div class="invalid" v-if="name.name.$error">A full name is required.</div>
                        </div>
                        <div class="field">
                            <p class="control  has-icons-left ">
                                <input class="input" :class="{invalid: name.email.$invalid }"
                                       type="email"
                                       placeholder="Email - Required"
                                       v-model.trim="name.email.$model"
                                >
                                <span class="icon is-small is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                            </p>
                            <div class="invalid" v-if="name.email.$error">A valid email is required.</div>
                        </div>
                        <div class="field">
                            <p class="control  has-icons-left ">
                                <input class="input"
                                       type="text"
                                       placeholder="Phone"
                                       v-model.trim="name.phone.$model"
                                >
                                <span class="icon is-small is-left">
                                            <i class="fas fa-phone"></i>
                                        </span>
                            </p>
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
                                       v-model="address.street">
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
                                <input class="input" type="text" name="city" v-model="address.city">
                            </p>
                        </div>
                        <div class="field-label">
                            <label class="label">State/Prov</label>
                        </div>
                        <div class="control">
                            <p class="control is-expanded ">
                                <input class="input" type="text" name="state" v-model="address.state">
                            </p>
                        </div>
                        <div class="field-label">
                            <label class="label">Zip/Postal</label>
                        </div>
                        <div class="control">
                            <p class="control is-expanded ">
                                <input class="input" type="text" name="zip" v-model="address.zip">
                            </p>
                        </div>
                    </div>
                </div>

                <div class="box">
                    <p class="notification">2. Choose your membership category. Donations to AACTMAD are tax deductible. Memberships
                        at the Donor level and higher can be acknowledged in the Annual Directory:</p>

                    <div class="field is-horizontal">
                        <div class="field-label">
                            <label class="label"></label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <div class="select">
                                        <select v-model="category">
                                            <option v-for="k in Object.keys(categories)" v-bind:value="k">
                                                {{ '$'+categories[k]+' '+k }}
                                            </option>
                                        </select>
                                    </div>
                                    <table class="table is-narrow">
                                        <tbody>
                                        <tr>
                                            <td class="has-text-right has-text-weight-bold">Subtotal:</td>
                                            <td class="has-text-right">{{ categories[category] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="has-text-right has-text-weight-bold">PayPal Surcharge:</td>
                                            <td class="has-text-right">{{ surcharge }}</td>
                                        </tr>
                                        <tr>
                                            <td class="has-text-right has-text-weight-bold">Total Cost:</td>
                                            <td class="has-text-right">{{ totalCost }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box">
                    <p class="notification">
                        3. Check items you want omitted from the directory:</p>
                    <div class="field is-horizontal">
                        <div class="field-label">
                            <label class="label"></label>
                        </div>
                        <div class="field-body">
                            <div class="field ">
                                <div class="control">
                                    <label class="checkbox">
                                        <input type="checkbox"
                                               value="Name"
                                               v-model="excludedFromDirectory">
                                        Name |
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox"
                                               value="Address"
                                               v-model="excludedFromDirectory">
                                        Address |
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox"
                                               value="Phone"
                                               v-model="excludedFromDirectory">
                                        Phone |
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox"
                                               value="Email"
                                               v-model="excludedFromDirectory">
                                        Email |
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox"
                                               value="Donation Level"
                                               v-model="excludedFromDirectory">
                                        Donation Level
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </form>


        <div style="display: none;">

            <form id="paypalForm" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" id="amount" name="amount" value="10">
                <input type="hidden" name="business" value="paypal@aactmad.org" />
                <input type="hidden" name="return" value="https://aactmad.org/membership" />
                <input type="hidden" name="item_name" value="AACTMAD Membership" />
                <input type="hidden" id="item_number" name="item_number" value="123456" />
                <input type="hidden" name="cancel_return" value="https://aactmad.org/membership" />
                <input type="hidden" name="rm" value="2" />
                <input type="hidden" name="currency_code" value="USD">
                <input type="submit" value="Pay with PayPal" />
                <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
        </div>


    </div>


</template>

<script>
    import axios from 'axios';
    import moment from 'moment';
    const {required, minLength, email} = require('vuelidate/lib/validators');

    class Address {
        constructor() {
            this.street = '';
            this.city = '';
            this.state = '';
            this.zip = '';
        }
    }
    class Name {
        constructor() {
            this.name = '';
            this.email = '';
            this.phone = '';
        }
    }

    export default {
        name: "member-registration",
        data() {
            return {
                categories: {
                    Student: 10,
                    'Limited Income Individual': 10,
                    Individual: 15,
                    Family: 25,
                    Friend: 30,
                    Supporter: 50,
                    Donor: 100,
                    Sustainer: 250,
                    Benefactor: 500,
                    Patron: 1000
                },
                category: 'Individual',
                surchargedItems: {
                    Student: 1,
                    'Limited Income Individual': 1,
                    Individual: 1,
                    Family: 1,
                },
                names: [new Name()],
                address: new Address(),
                excludedFromDirectory: [],
                itemNumber: "",
            }
        },
        validations: {
            names: {
                $each: {
                    name: {
                        required,
                        minLength: minLength(4)
                    },
                    email: {
                        required,
                        email,
                    },
                    phone: {},
                }
            },
        },
        mounted() {
        },
        computed: {
            surcharge() {
                return this.surchargedItems[this.category] ? this.surchargedItems[this.category] : 0;
            },
            totalCost() {
                return this.categories[this.category] + this.surcharge;
            },
        },
        methods: {
            addName() {
                this.names.push(new Name());
                this.category = 'Family';
            },
            removeName() {
                this.names.pop();
                if (this.names.length == 1) this.category = 'Individual';
            },
            testPost() {
                this.doLogging();
                this.doMailToDancer();
            },
            assembleMessage() {
                return {
                    ItemNumber: this.itemNumber,
                    Names: this.names,
                    Address: this.address,
                    Category: {Description: this.category, Value: this.categories[this.category]},
                    ExcludeFromDirectory: this.excludedFromDirectory,
                }
            },
            doLogging() {
                let log = {
                    secret: 'iamthebossofaactmad',
                    logfile: 'membership.txt',
                    message: this.assembleMessage(),
                };
                // console.log(JSON.stringify(log));

                let headers = {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'};
                axios.post('https://assets.aactmad.org/logger.php', log, {headers: headers})
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            doMailToDancer() {
                let headers = {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'};
                let message = this.assembleMessage();
                axios.post('/membership.email.php', message, {headers: headers})
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            processMembership() {
                this.itemNumber = this.names[0].name + " - " + moment().format();
                this.doLogging();
                this.doMailToDancer();

                let paypalForm = document.getElementById('paypalForm');
                let amount = document.getElementById('amount');
                amount.value = this.totalCost;
                let item_number = document.getElementById('item_number');
                item_number.value = this.itemNumber;
                paypalForm.submit();
            }
        }
    }
</script>

<style scoped>

    [v-cloak] {
        display: none;
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
    }

    .message {
        display: inline-block;
        /*padding: 0.50rem 1rem;*/
    }

    .message-body {
        padding: 0.55rem 1rem;
    }


</style>