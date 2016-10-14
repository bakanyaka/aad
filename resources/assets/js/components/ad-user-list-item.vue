<template>
    <tr>
        <td><span v-if="user.disabled" class="label label-danger">Отключен</span><span v-else class="label label-primary">Активен</span></td>
        <td>{{user.name}}</td>
        <td>{{user.email}}</td>
        <td>{{user.title}}</td>
        <td>{{phoneNumber}}</td>
        <td>{{user.departmentName}}</td>
        <td>{{user.office}}</td>
        <td>{{lastLogonDate}}</td>
        <td nowrap>
            <a v-on:click="emitShowComputers" class="btn btn-white" data-toggle="tooltip" data-placement="left" title="Показать компьютеры">
                <i class="fa fa-laptop text-navy fa-lg"></i>
            </a>
            <a href="#" class="btn btn-white" data-toggle="tooltip" data-placement="left" title="Скопировать в буфер">
                <i class="fa fa-clipboard text-navy fa-lg"></i>
            </a>
            <a v-bind:href="'/todo/issues/new?user=' + user.account" class="btn btn-white" data-toggle="tooltip" data-placement="left" title="Создать задачу">
                <i class="fa fa-check-square-o text-navy fa-lg"></i>
            </a>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['user','index'],
        data () {
            return {
            }
        },
        mounted () {
            this.$nextTick(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        },
        computed: {
            phoneNumber: function () {
                const phones = [];
                if (this.user.localPhone != null) {
                    phones.push(this.user.localPhone)
                }
                if (this.user.cityPhone != null) {
                    phones.push(this.user.cityPhone)
                }
                if (this.user.mobilePhone != null) {
                    phones.push(this.user.mobilePhone)
                }
                return phones.join(', ');
            },
            lastLogonDate: function () {
                const lastLogonDate = new Date(this.user.lastLogonDateUnix*1000);
                return lastLogonDate.toLocaleString('ru-RU',{timezone: 'Europe/Moscow'});
            }

        },
        methods: {
            emitShowComputers: function () {
                this.$emit('showComputers', this.index)
            }
        }
    }
</script>