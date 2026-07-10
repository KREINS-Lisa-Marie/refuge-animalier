<x-public.app title="{{__('general.contact')}}">
    <h2 class="page-title color-dark fw-700  t-a-center ">
        {{__('public/contact.contact_us')}}
    </h2>

    <form action="" method="POST" class="form  web-margin-l-r-auto background-light border-r-small m-lr-24 m-b-60-150 public-form">

        <h2 class=" fw-700 p-b-32 t-a-center color-dark form-title">
            {{__('public/contact.contact_form')}}
        </h2>
        <p class="italic m-b-32 interl-text">
            {{__('public/contact.fill_out_form')}}
        </p>

        <fieldset>

            <p class="obligations m-b-32">
                {{__('public/contact.mandatory_fields')}}
            </p>

            <div class="web-flex flex-gap-24 flex-wrap">

                <x-fields.text name="firstname" id="firstname" value="" placeholder="John" wire="">

                    {{__('public/contact.first_name_mandatory')}}
                </x-fields.text>

                <x-fields.text name="lastname" id="lastname" value="" placeholder="Doe" wire="">

                    {{__('public/contact.lastname_mandatory')}}
                </x-fields.text>

                <x-fields.email value="" wire="">
                    {{__('public/contact.email_mandatory')}}
                </x-fields.email>


                <div class="field p-b-32">
                    <label for="subject" class="field__label">
                        {{__('public/contact.concerning')}}
                    </label>
                    <select name="subject-select" id="subject-select"
                            class="field__select background-white p-16 border-r-big " aria-required="true">
                        <option value="">{{__('public/contact.choose_subject')}}</option>
                        <option value="information">
                            {{__('public/contact.general_info')}}</option>
                        <option value="volunteer">
                            {{__('public/contact.volunteer')}}</option>
                        <option value="volunteer">
                            {{__('public/contact.adoption_request')}}</option>
                    </select>
                </div>
            </div>


            @component('components.fields.textarea', ['name' => 'message', 'id'=>'message', 'value' =>'',
            'placeholder' => __('public/contact.message_placeholder'), 'old_values' =>  "", 'wire'=>""])
                {{__('public/contact.message')}}
            @endcomponent


        </fieldset>
        <button type="submit"
                class="btn contact-form-btn background-dark color-white dark-button-background min-w-130 border-r-big margin-l-r-auto m-t-32 d-block p-16-32">{{__('public/contact.send')}}
        </button>
    </form>
</x-public.app>
