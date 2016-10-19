<template>
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-4">
                <div class="input-group">
                    <input type="text" v-model="searchText" v-on:keyup.enter="getUsers" placeholder="Имя пользовтеля или учетная запись" class="input-sm form-control">
                    <span class="input-group-btn">
                        <button type="button" v-on:click="getUsers" class="btn btn-sm btn-primary"> Поиск</button>
                    </span>
                </div>
            </div>
            <div class="col-sm-6 m-b-xs col-sm-offset-2"><select class="input-sm form-control input-s-sm inline">
                <option value="0">Все подразделения</option>
                <option value="1">Отдел номер 1</option>
                <option value="2">Option 3</option>
                <option value="3">Option 4</option>
            </select>
            </div>
        </div>
        <div class="table-responsive m-t-lg animated fadeIn" v-if="showTable">
            <table class="table table-striped table-condensed ad-user-table">
                <thead>
                <tr>
                    <th>Cтатус</th>
                    <th>ФИО</th>
                    <th>E-mail</th>
                    <th>Должность</th>
                    <th>Номер телефона</th>
                    <th>Подразделение</th>
                    <th>Местоположение</th>
                    <th>Дата логина</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                <template v-for="(user, index) in users">
                    <tr is="ad-user-list-item"  v-bind:user="user" v-bind:index="index" v-on:showComputers="onShowComputers"></tr>
                    <tr v-if="user.showcomputers">
                        <td colspan="9">
                            <uL>
                                <li v-for="computer in user.computers">
                                    {{computer.name}}
                                </li>
                            </uL>
                            <i v-if="user.loading" class="fa fa-spinner fa-spin fa-2x fa-fw"></i>
                            <span v-if="!user.loading && user.computers.length == 0">
                                Компьютеров не найдено
                            </span>
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>
        <div v-if="loading" class="text-center m-lg">
            <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</template>

<script>
    import AdUserListItem from './ad-user-list-item.vue';
    export default {
        components: {AdUserListItem},
        data () {
            return {
                searchText: '',
                users: [],
                showTable: false,
                loading: false
            }
        },
        watch: {
            searchText: _.debounce(function () {
                    this.getUsers();
            }, 1000)
        },
        methods: {
            onShowComputers: function (index) {
                let user = this.users[index];
                if (typeof user.showcomputers !== 'undefined') {
                    return;
                }
                Vue.set(user,'showcomputers', true);
                Vue.set(user,'loading', true);
                this.$http.get('computers/search?username=' + user.account).then((response) => {
                    user.loading = false;
                    Vue.set(user, 'computers', response.body);
                });
            },
            getUsers: function () {
                if (!this.searchText.trim()) {
                    return
                }
                this.showTable = false;
                this.loading = true;
                this.$http.get('/users/search?q=' + this.searchText).then((response) => {
                    this.showTable = true;
                    this.loading = false;
                    this.users = Array.isArray(response.body) ? response.body : [response.body];
                })
            }
        }
    }
</script>
<style>
    .ad-user-table tbody > tr > td {
        vertical-align: middle;
    }
</style>