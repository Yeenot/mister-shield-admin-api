<template>
    <div class="__datepicker-wrapper">
        <input type="hidden" :name="name" v-model="realValue">
        <input type="text" class="form-control" :class="ControlClass" ref="input">
        <div class="invalid-feedback" v-if="realError">{{ realError }}</div>
    </div>
</template>

<script>
export default {
    props: [
        "value",
        "initial",
        "name",
        "config",
        "error",
        "initialError"
    ],

    data() {
        return {
            default: {
                config: {
                    todayHighlight: !0,
                    autoclose: !0,
                    format: 'dd/mm/yyyy'
                }
            },
            format: {
                from: "MM/DD/YYYY",
                to: "DD/MM/YYYY",
            },
            realValue: null
        }
    },

   mounted: function() {
        var vm = this;
        $(document).ready(function() {
            vm.default.config = Object.assign({}, vm.default.config, vm.config);
            $(vm.$refs.input).datepicker(vm.default.config)
                .on('change', function(event){
                    vm.onDateChanged(event);
                });
            var initial = (vm.$helper.isNotNull(vm.initial)) ? vm.initial : vm.value;
            vm.setValue(initial);

            if (vm.$helper.isNotNull(vm.initialError)) {
                vm.setError(vm.initialError);
            }
        });
    },

    watch: {
        value(value) {
            this.setValue(value);
        }
    },

    computed: {
        ControlClass() {
            return { 'is-invalid': this.realError };
        },

        realError: {
            get() {
                return this.error;
            },

            set(value) {
                this.setError(value);
            }
        }
    },

    methods: {
        onDateChanged(event) {
            var value = $(event.target).val();
            this.realValue = (value) ? moment(value, this.format.to).format(this.format.from) : null;
            this.$emit('input', value);
        },

        setValue(value) {
            var element = $(this.$refs.input);
            var currentDt = moment(element.val() ?? '');
            var dt = moment(value ?? '');
            if (dt.isValid()) {
                if (!currentDt.isValid() || (currentDt.isValid() && !dt.isSame(currentDt))) {
                    element.data("datepicker").setDate(dt.toDate());
                    element.trigger('change');
                }
            } else {
                if (currentDt.isValid()) {
                    element.val('');
                    element.datetimepicker('update');
                }
            }
        },

        setError(value) {
            this.$emit('update:error', value);
        }
    },

    destroyed() {
        $(this.$refs.input).datepicker('remove');
    }
}
</script>

<style lang="scss" scoped>
</style>