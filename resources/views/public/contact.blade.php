@component('layouts.app')

    <h2 class="page-title color-dark fw-700  t-a-center ">
        Contactez-nous
    </h2>

    <form action="" method="POST" class="form  web-margin-l-r-auto background-light border-r-small m-lr-24 m-b-60-150 ">

        <h2 class=" fw-700 p-b-32 t-a-center color-dark form-title">
            Formulaire de contact
        </h2>
    <p class="italic m-b-32">
        Pour nous contacter, veuillez s.v.p. remplir le formulaire. Nous allons vous contacter dès que possible. Si vous voulez adopter un animal, veuillez s.v.p. renseigner son nom.
    </p>

    <fieldset>

        <p class="obligations m-b-32">* Champs obligatoires
        </p>

        <div class="web-flex flex-gap-24 flex-wrap">

                <x-fields.text name="firstname" id="firstname" value="" placeholder="John">
                    Prénom*
                </x-fields.text>

            <x-fields.text name="lastname" id="lastname" value="" placeholder="Doe">
                Nom*
            </x-fields.text>

                <x-fields.email value="">
                    Adresse Email*
                </x-fields.email>


            <div class="field p-b-32">
                <label for="subject" class="field__label">
                    Concernant*
                </label>
                <select name="subject-select" id="subject-select"
                        class="field__select background-white p-16 border-r-big " aria-required="true">
                    <option value="">--Choisissez un sujet--</option>
                    <option value="information">Informations générales</option>
                    <option value="volunteer">Bénévolat</option>
                    <option value="volunteer">Demande d'adoption</option>
                </select>
            </div>
        </div>


        @component('components.fields.textarea', ['name' => 'message', 'id'=>'message', 'value' =>'', 'placeholder' => 'Bonjour,
                Je voudrais bien m’informer à propros du bénévolat.
                Bonne journée,
                John Doe', 'old_values' =>  ""])
            Message*
        @endcomponent


    </fieldset>
    <button type="submit" class="btn contact-form-btn background-dark color-white dark-button-background min-w-130 border-r-big margin-l-r-auto m-t-32 d-block p-16-32">Envoyer</button>
</form>
@endcomponent
