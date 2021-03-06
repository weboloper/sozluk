{% extends "layouts/base.volt" %}
{% block content %}
<div id="content-full">
	<h2>kaydol</h2>
	{{ form('class': 'form-signup') }}
    <fieldset>
    	<div class="form-group">
		    {{ form.render('name') }}
		    {{ form.messages('name') }}
		</div>
		<div class="form-group">
		    {{ form.render('username') }}
		    {{ form.messages('username') }}
		</div>
	  	<div class="form-group">
		    {{ form.render('email') }}
		    {{ form.messages('email') }}
		</div>
		<div class="form-group">
			{{ form.render('password') }}
			{{ form.messages('password') }}
		</div>
		<div class="form-group">
			{{ form.render('confirmPassword') }}
			{{ form.messages('confirmPassword') }}
		</div>
		<div class="checkbox">
	    	<label>
	    		{{ form.render('terms') }} {{ form.label('terms') }}
	    	</label>
	    	{{ form.messages('terms') }}
	    </div>
	    <input type="hidden" name="{{ security.getTokenKey() }}" value="{{ security.getToken() }}" >

		 {{ submit_button('kaydol', 'class' : 'btn btn-success') }}
	</fieldset>
	
  	</form>
		 
</div>
 
{% endblock %}

 
