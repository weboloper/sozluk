<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse mb-2">
    <div class="container">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/">{{name}}</a>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">

        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
          </li>
        </ul>

        {% if auth.isLogged() != true %}
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="/session/login">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/session/signup">Register</a>
            </li>
          </ul>
          {% else %}
          <ul class="navbar-nav">
            {% if auth.isTrustModeration() == true %}
            <li class="nav-item">
              <a class="nav-link" href="/backend">Backend</a>
            </li>
            {% endif %}
            <li class="nav-item">
              <a class="nav-link" href="/users/changePassword">Change password</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/session/logout">Logout</a>
            </li>
          </ul>
        {% endif %}


      </div>
    </div>
</nav>