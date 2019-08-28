<template>
    <div v-cloak>
        <form @submit.prevent="processMembership()">
            <button type="submit" :disabled="$v.$invalid"
                    class="button is-info">Subscribe
            </button>

            <div class="box">

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">Name/Email</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control  has-icons-left">
                                <input class="input " :class="{invalid: $v.name.$invalid }"
                                       type="text"
                                       placeholder="Full Name - Required"
                                       v-model.trim="$v.name.$model"
                                >
                                <span class="icon is-small is-left"><i class="fas fa-user"></i>
                                        </span>
                            </p>
                            <div class="invalid" v-if="$v.name.$error">A full name is required.</div>
                        </div>
                        <div class="field">
                            <p class="control  has-icons-left ">
                                <input class="input" :class="{invalid: $v.email.$invalid }"
                                       type="email"
                                       placeholder="Email - Required"
                                       v-model.trim="$v.email.$model"
                                >
                                <span class="icon is-small is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                            </p>
                            <div class="invalid" v-if="$v.email.$error">A valid email is required.</div>
                        </div>
                        <div class="field">
                            <p class="control  has-icons-left ">
                                <input class="input" :class="{invalid: $v.repeatemail.$invalid }"
                                       type="email"
                                       placeholder="Email - Required"
                                       v-model.trim="$v.repeatemail.$model"
                                >
                                <span class="icon is-small is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                            </p>
                            <div class="invalid" v-if="$v.repeatemail.$error">Emails must be identical.</div>
                        </div>
                    </div>
                </div>


                <div class="box">
                    <div class="field is-horizontal">
                        <div class="field-label">
                            <label class="label"></label>
                        </div>
                        <div class="field-body">
                            <div class="field ">
                                <div class="control">
                                    <label class="checkbox">
                                        <input type="checkbox"
                                               value="contra"
                                               v-model="emailListToJoin">
                                        Contra Dance |
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox"
                                               value="english"
                                               v-model="emailListToJoin">
                                        English Country Dance |
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox"
                                               value="swing"
                                               v-model="emailListToJoin">
                                        Swing Dance |
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox"
                                               value="concerts"
                                               v-model="emailListToJoin">
                                        Concerts
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </form>

        <div class="notification box">
            <strong>Pittsfield Open Band</strong> : To join the POB email list, sign up at their
            <a target="_blank" href="http://groups.yahoo.com/group/POBmembers/">Yahoo group</a>
            .
        </div>


    </div>


</template>

<script>
    import axios from 'axios';
    const {required, minLength, email, sameAs} = require('vuelidate/lib/validators')

    export default {
        name: "email-lists",
        data() {
            return {
                name: "",
                email: "",
                repeatemail: "",
                emailListToJoin: [],
            }
        },
        validations: {
            name: {
                required,
                minLength: minLength(4)
            },
            email: {
                required,
                email,
            },
            repeatemail: {
                sameAsEmail: sameAs('email')
            },
            emailListToJoin: {
                required,
            }
        },
        mounted() {
        },
        computed: {},
        methods: {
            testPost() {
                this.doLogging();
                this.doMailToDancer();
            },
            assembleMessage() {
                return {
                    Name: this.name,
                    Email: this.email,
                    Lists: this.emailListToJoin,
                }
            },
            doLogging() {
                let log = {
                    secret: 'iamthebossofaactmad',
                    logfile: 'email.lists.txt',
                    message: this.assembleMessage(),
                };

                let headers = {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'};
                return axios.post('https://assets.aactmad.org/logger.php', log, {headers: headers});
            },
            doMailToDancer() {
                let headers = {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'};
                let message = this.assembleMessage();
                return axios.post('/php/email.lists.email.php', message, {headers: headers});
            },
            processMembership() {
                let log = this.doLogging();
                let mail = this.doMailToDancer();

                Promise.all([log, mail])
                    .then(
                        () => alert("Thank you. You have been subscribed.")
                        )
                    .catch(error => {
                        console.log(error.message)
                    });
                // window.location.reload();
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
