{% block content %}
<div class="container">
    <div class="col-md-4 offset-md-4">
        <div class="card">

            <div class="card-header">
                Şifre değiştir
            </div>

            <div class="card-block">
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

        </div>
    </div>
</div>
{% endblock %}