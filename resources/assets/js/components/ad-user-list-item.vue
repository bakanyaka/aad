<template>
    <tr>
        <td>{{user.name}}</td>
        <td>{{user.title}}</td>
        <td>{{phoneNumber}}</td>
        <td>{{user.departmentName}}</td>
        <td>{{user.office}}</td>
        <td>{{user.lastLogonDate}}</td>
        <td>
            <a v-on:click="emitShowComputers"><i class="fa fa-laptop text-navy fa-lg"></i></a>
            <a href="#"><i class="fa fa-clipboard text-navy m-l-xs fa-lg"></i></a>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['user','index'],
        data () {
            return {
                msg: 'Hello world!'
            }
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
            }
        },
        methods: {
            emitShowComputers: function () {
                this.$emit('showComputers', this.index)
            }
        }
    }
</script>

<style>
    .example {
        color: red;
    }
</style>