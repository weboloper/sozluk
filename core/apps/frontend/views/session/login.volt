{% extends "layouts/base.volt" %}
{% block content %}
<div id="content-full">
	<h2>giriş</h2>
 	{{ form('class': 'form-login') }}
    <fieldset>
	  	<div class="form-group">
		    {{ form.render('email') }}
		    {{ form.messages('email') }}
		</div>
		<div class="form-group">
			{{ form.render('password') }}
			{{ form.messages('password') }}
		</div>
		<div class="checkbox">
	    	<label>
	    		{{ form.render('remember') }} {{ form.label('remember') }}
	    	</label>
	    </div>
		 <input type="hidden" name="{{ security.getTokenKey() }}" value="{{ security.getToken() }}" >

		 {{ submit_button('gir', 'class' : 'btn btn-success') }}
	</fieldset>
	
  	</form>

 	{{ link_to("session/signup", "kaydol") }} | 
	{{ link_to("session/forgotPassword", "şifre gitti") }}
</div>
 
{% endblock %}
