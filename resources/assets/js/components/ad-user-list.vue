<template>
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-4">
                <div class="input-group">
                    <input type="text" placeholder="Имя пользовтеля или учетная запись" class="input-sm form-control">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-primary"> Поиск</button>
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
        <div class="table-responsive m-t-lg">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ФИО</th>
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
                        <td colspan="7">
                            <li v-for="computer in user.computers">
                                {{computer}}
                            </li>
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import AdUserListItem from './ad-user-list-item.vue';
    export default {
        components: {AdUserListItem},
        data () {
            return {
                users: [{
                    name: 'Пупкин Василий Иванович',
                    title: 'Сантехник',
                    localPhone: '53-27',
                    cityPhone: '292-4044',
                    mobilePhone: '+7 (911) 344-00-22',
                    departmentName: 'Управление канализационных систем',
                    office: 'Здание 18, 1 этаж, Комната 3',
                    disabled: false,
                    showcomputers: false,
                    computers: []
                },
                {
                    name: 'Иванов Александр Иванович',
                    title: 'Водопроводчи',
                    localPhone: '33-27',
                    cityPhone: '292-4344',
                    mobilePhone: '+7 (902) 334-00-22',
                    departmentName: 'Управление канализационных систем',
                    office: 'Здание 22, 1 этаж, Комната 3',
                    disabled: false,
                    showcomputers: false,
                    computers:[]
                }]
            }
        },
        methods: {
            onShowComputers: function (index) {
                this.users[index].computers.push('it-016', 'otd147-01061601');
                this.users[index].showcomputers = true
            }
        }
    }
</script>