<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse mb-2">
    <div class="container">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/"><?= $name ?></a>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">

        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Anasayfa <span class="sr-only">(current)</span></a>
          </li>
        </ul>   

        <?= var_dump($this->callMacro('is_authorized', [])) ?>   
      
      </div>
    </div>
</nav>