<template>
    <div>
        <section class="card">
            <h4 class="card-header">
                titre, date et heure du jury
            </h4>
            <div class="card-body">
                <label for="jiriTitle" class="">Titre&nbsp;:</label>
                <input class="form-control" type="text" name="jiriTitle" id="jiriTitle" placeholder="Jury Janvier 2018 - 2eme infographie - web" v-model="name">
                <hr>
                <label for="jiriDate" class="">Date&nbsp;:</label>
                <input class="form-control" type="date" name="jiriDate" id="jiriDate" v-model="date">
                <hr>
                <label for="jiriTime" class="">Heure&nbsp;:</label>
                <input class="form-control" type="time" name="jiriTime" id="jiriTime" v-model="time">
            </div>
        </section>
        <br>
        <button class="btn btn-primary" @click="sendData">suivant</button>
    </div>
</template>

<script>
    import router from '../../router';
    export default {
        name: "BasicInfos",
        data(){
            return {
                date: null,
                name: null,
                time: null
            }
        },
        methods: {
            sendData(){
                window.axios.post('/jiri', {name: this.name, date: this.date, time: this.time})
                    .then(function (response) {
                        router.push({name: 'addJudges'});
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>

<style scoped>

</style>
