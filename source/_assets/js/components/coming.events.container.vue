<template>
    <div>
        <div v-if="eventsToDisplay.length > 0">
            Special Announcements:
            <div class="columns is-multiline is-centered">
                <div class="column is-6" v-for="event in eventsToDisplay">
                    <a :href="event.moreInfoUrl">
                        <figure class="image " style="max-height: 200px">
                            <img :src="event.bannerUrl" style="max-height: 200px">
                        </figure>
                    </a>
                </div>
            </div>
            <hr>
        </div>

    </div>

</template>

<script>
    import axios from 'axios';
    import moment from 'moment';

    export default {
        name: "coming-events-container",
        data() {
            return {
                coming: [],
                eventsToDisplay: [],
            }
        },
        mounted() {
            this.getComingEventsJson();
        },
        methods: {
            getComingEventsJson() {
                axios.get('https://assets.aactmad.org/coming.events.json')
                    .then((response) => {
                        this.coming = response.data;
                        this.getEventsToDisplay();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getEventsToDisplay() {
                let now = moment();
                this.coming.forEach((event) => {
                    if (now.isBetween(event.begin, event.end, 'day', '[]'))
                        this.eventsToDisplay.push(event);
                });
            },
        },
    }
</script>

<style scoped>

</style>
