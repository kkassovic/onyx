<h2>Prihlásenie do systému EP</h2>

<form class="pure-form pure-form-stacked" method="post" action="">
<?php //echo $form_action;?>
    <fieldset>
        <legend>Prihlasovacie údaje</legend>

        <label for="user">Meno</label>
        <input id="user" name="user" type="text" placeholder="">

        <label for="password">Heslo</label>
        <input id="password" name="password" type="password" placeholder="">
        <br>
        <button class="pure-button pure-button-primary"
                type="submit"
                name="submit"
                id="submitID">
                Prihlásiť
        </button>
    </fieldset>
</form>