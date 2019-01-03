<template>
        <div v-if="componentReady" class="container">
            <h1>voici tous tes jurys</h1>
            <div v-if="userJiries.length">
                <div class="list-group">
                    <jiri-list-item v-for="jiri in userJiries" :jiri="jiri" :key="jiri.id"></jiri-list-item>
                </div>
            </div>
            <div v-else>
                il semblerai que tu n'as pas encore créé de jury
            </div>
        </div>
        <div v-else>
            plz wait...
        </div>
</template>

<script>
    import {mapState} from 'vuex';
    import JiriListItem from "./JiriListItem";
    export default {
        name: "JiriList",
        components: {JiriListItem},
        data(){
            return {
                componentReady: false
            }
        },
        computed:{
            ...mapState(['userJiries', 'currentUser'])
        },
        methods:{},
        mounted(){
            this.$store.dispatch('setCurrentUser')
                .then(() => {
                    this.$store.dispatch('setUserJiries')
                        .then(() => {
                            this.componentReady = true;
                        })
                })
        }

    }
</script>

<style scoped>

</style>
