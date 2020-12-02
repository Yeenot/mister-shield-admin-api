<template>
    <div class="country-selector" @mouseover="active = true" @mouseout="active=false">
        <div id="nalg">
            <img :src="$flags(code)" :alt="name" />
        </div>
        <div class="lang-dropdown" id="langHolder" :class="{'active': active}">
            <div class="findLang" v-for="(country, index) in items" :key="index" @click="onChange(country)">
                <img :src="$flags(country.code)" :alt="country.name" />
                {{ country.name.toUpperCase() + (country.status === 'draft' ?  (' (' +$t('customer/messages.soon').toUpperCase() + ')') : '') }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'country-selector',
    props: ['items', 'value', 'initial'],

    data() {
        return {
            country: null,
            active: false
        }
    },

    mounted() {
        this.country = this.initial ?? this.value;
    },

    watch: {
        value(value) {
            this.country = value;
        },

        country(value) {
            this.$emit('input', value);
        }
    },

    computed: {
        code() {
            return (this.country ?? {}).code ? this.country.code : null;
        },
        name() {
            return (this.country ?? {}).name ?? null;
        }
    },

    methods: {
        onChange(country) {
            if(country.status === 'draft') return;
            this.country = country;
            this.$emit('change', country);
        }
    }
}
</script>
