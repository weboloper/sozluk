{% extends "layouts/base.volt" %}
{% block content %}
<div id="content-full">
	<h2>şifre hatırlat</h2>
    {{ form('class': 'form-forgotpass') }}
    <fieldset>
	  	<div class="form-group">
		    {{ form.render('email') }}
		</div>
	 
		 {{ submit_button('Şifremi hatırlat', 'class' : 'btn btn-success') }}
	</fieldset>
	
  	</form>
			 
</div>
{% endblock %}