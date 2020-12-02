<form class="book-form">
    <div class="columns no-marg">
        <div class="column is-6">
            <input type="text" v-model="booking.name" placeholder="{{ strtoupper(__('customer/forms.booking_name')) }} *" />
        </div>
        <div class="column is-6">
            <input type="text" v-model="booking.business_name" placeholder="{{ strtoupper(__('customer/forms.booking_business_name')) }}" />
        </div>
    </div>
    <div class="columns no-marg">
        <div class="column is-6">
            <input type="text" v-model="booking.phone" placeholder="{{ strtoupper(__('customer/forms.booking_phone')) }} *" />
        </div>
        <div class="column is-6">
            <input type="email" v-model="booking.email" placeholder="{{ strtoupper(__('customer/forms.booking_email')) }} *" />
        </div>

    </div>
    <div class="columns no-marg">
        <div class="column is-6">
            <select @change="doChangePropertyType" v-model="booking.property_type">
                <option value="">{{ strtoupper(__('customer/forms.booking_select_type_of_property')) }} *</option>
                @foreach (['residential', 'commercial', 'public'] as $type)
                    <option value="{{ $type }}">{{ __('customer/forms.booking_type_of_property_'.$type) }}</option>
                @endforeach
            </select>
        </div>
        <div class="column is-6">
            <select v-model="booking.category_id" :disabled="!$helper.isNotNull(booking.property_type) || categories.length == 0">
                <option value="">{{ strtoupper(__('customer/forms.booking_category')) }}</option>
                <option v-for="(category, index) in categories" :key="index" :value="category.id">@{{ category.name }}</option>
            </select>
        </div>
    </div>

    <div class="columns no-marg">
        <div class="column is-6">
            <input type="text" v-model="booking.area"
                placeholder="{{ strtoupper(withUnit(__('customer/forms.booking_area_size'), __('customer/forms.booking_area_unit_' . $main['country']->area_unit))) }} *" />
        </div>
        <div class="column is-6">
            <select v-model="booking.service_id" :disabled="!$helper.isNotNull(booking.property_type) || requestedServices.length == 0">
                <option value="">{{ strtoupper(__('customer/forms.booking_requested_select_service')) }}</option>
                <option v-for="(service, index) in requestedServices" :key="index" :value="service.id">@{{ service.name }}</option>
            </select>
        </div>
    </div>

    <div class="columns no-marg">
        <div class="column is-6">
            <datetime placeholder="{{ strtoupper(__('customer/forms.booking_requested_service_date')) }}" value-zone="Asia/Bangkok" v-model="booking.date"></datetime>

        </div>
        <div class="column is-6">
            <datetime placeholder="{{ strtoupper(__('customer/forms.booking_requested_service_time')) }}" value-zone="Asia/Bangkok" type="time" v-model="booking.time"></datetime>

        </div>
    </div>

    <div class="columns no-marg">
        <div class="column is-12">
            <textarea v-model="booking.address" placeholder="{{ strtoupper(__('customer/forms.booking_address')) }} *" ></textarea>
            <label class="address-desc">* {{ __('customer/forms.booking_address_note') }}</label>
            <br>
            <div class="form-areas">
                @foreach($main['country']->cities()->onlyActive()->get() as $city)
                    @if($city->districts()->onlyActive()->count())
                        {{ $city->name . ': ' . implode(', ', $city->districts()->onlyActive()->pluck('name')->toArray()) }} <br>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="columns no-marg">
        <div class="column is-12">
            <textarea v-model="booking.notes"  class="notes" placeholder="{{ strtoupper(__('customer/forms.booking_notes')) }}"></textarea>
        </div>
    </div>

    <div class="has-text-centered">
        <button class="button-regular" :disabled="btnSubmitDisabled" @click="doSubmit" type="button">{{ __('customer/buttons.submit') }}</button>
    </div>
</form>
