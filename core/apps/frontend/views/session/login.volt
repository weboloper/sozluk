{% block content %}
<div class="container">
        <div class="col-md-4 offset-md-4">
        	<div class="card card-default mt-5">
			  	<div class="card-header">
			    	Giriş
			 	</div>
			  	<div class="card-block">
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

			    		 {{ submit_button('Giriş yap', 'class' : 'btn btn-success') }}
			    	</fieldset>
			    	
			      	</form>
			    </div>
			    <div class="card-footer text-muted">
			    	{{ link_to("session/forgotPassword", "Şifremi unuttum") }}
			    </div>
			</div>
		</div>
</div>
{% endblock %}
