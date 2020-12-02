<template>
    <div class="locale-selector" @mouseover="active = true" @mouseout="active=false">
        <div id="lang">{{ initial.code.toUpperCase() }}</div>
        <div class="langDropdown" :class="{'active': active}" id="languages">
            <div class="Lang" @click="onChange(index)" v-for="(language, index) in items" :key="index" :value="index">
                {{ language.name.toUpperCase() }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'locale-selector',
    props: ['items', 'value', 'initial'],

    data() {
        return {
            realValue: null,
            active: false
        }
    },

    mounted() {
        this.realValue = this.getValue(this.initial ?? this.value);
    },

    watch: {
        value(value) {
            this.realValue = this.getValue(value);
        },

        realValue(value) {
            this.$emit('input', this.items[value]);
        }
    },

    methods: {
        getValue(selected) {
            var vm = this;
            var value = null;
            this.items.every((item, index) => {
                if (selected.id === item.id) {
                    value = index;
                    return false;
                }
                return true;
            });
            return value;
        },

        onChange(value) {
            this.$emit('change', this.items[value]);
        }

    }
}
</script>
