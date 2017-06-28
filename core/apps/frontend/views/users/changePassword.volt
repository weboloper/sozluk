{% extends "layouts/base.volt" %}
{% block content %}
<div id="content-full">
    <h2>şifre değiş</h2>
 
    {{ form('class': 'form-forgotpass') }}
        <fieldset>
            <div class="form-group">
                <label for="password">Password</label>
                {{ form.render("password") }}
            </div>

            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                {{ form.render("confirmPassword") }}
            </div>

            <div class="clearfix">
                {{ submit_button("Change Password", "class": "btn btn-primary") }}
            </div>
        </fieldset>
    </form>
             
</div>
{% endblock %}