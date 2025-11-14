@component('layouts.app')
<form action="" method="POST" class="form">
    <h2>
        Contactez-nous
    </h2>
    <p>
        Pour nous contacter, veuillez s.v.p. remplir le formulaire. Nous allons vous contacter dès que possible.
    </p>
    <p>
        Si vous voulez adopter un animal, veuillez s.v.p. renseigner son nom.
    </p>

    <fieldset>

        <p class="obligations">* Champs obligatoires
        </p>


        @component('components.fields.text', ['name' => 'firstname', 'id'=>'firstname', 'value' =>'', 'placeholder' => 'John'])
            Prénom*
        @endcomponent


        @component('components.fields.text', ['name' => 'lastname', 'id'=>'lastname', 'value' =>'', 'placeholder' => 'Doe'])
            Nom*
        @endcomponent


@component('components.fields.email', ['value'=> "" ])
            Adresse Email*
        @endcomponent


        <div class="field">
            <label for="subject" class="field__label">
                Concernant*
            </label>
            <select name="subject-select" id="subject-select" class="field__select" aria-required="true">
                <option value="">--Choisissez un sujet--</option>
                <option value="information">Informations générales</option>
                <option value="volunteer">Bénévolat</option>
                <option value="volunteer">Demande d'adoption</option>
            </select>
        </div>


        @component('components.fields.textarea', ['name' => 'message', 'id'=>'message', 'value' =>'', 'placeholder' => 'Bonjour,
                Je voudrais bien m’informer à propros du bénévolat.
                Bonne journée,
                John Doe', 'old_values' =>  ""])
            Message*
        @endcomponent


    </fieldset>
    <button type="submit" class="btn">Envoyer</button>
</form>
@endcomponent
