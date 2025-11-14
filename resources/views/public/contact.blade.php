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

        <div class="field">
            <label for="firstname" class="field__label">Prénom*</label>
            <input type="text" name="firstname" id="firstname" class="field__input" placeholder="John"
                   aria-required="true">

        </div>

        <div class="field">
            <label for="lastname" class="field__label">Nom*</label>
            <input type="text" name="lastname" id="lastname" class="field__input" placeholder="Doe"
                   aria-required="true">

        </div>

        <div class="field">
            <label for="email" class="field__label">Adresse Email*</label>
            <input type="email" name="email" id="email" class="field__input"
                   placeholder="johndoe@gmail.com" aria-required="true">
        </div>

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

        <div class="field">
            <label for="message" class="field__label">Message*</label>
            <textarea name="message" id="message"  placeholder="Bonjour,
                Je voudrais bien m’informer à propros du bénévolat.
                Bonne journée,
                John Doe"
                      aria-required="true">
            </textarea>
        </div>

    </fieldset>
    <button type="submit" class="btn">Envoyer</button>
</form>
@endcomponent
