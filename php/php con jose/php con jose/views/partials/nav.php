<nav class="navbar navbar-expand-lg navbar-light bg-secondary"> 
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-music-note-list text-warning" viewBox="0 0 16 16">
          <path d="M12 13c0 1.105-1.12 2-2.5 2S7 14.105 7 13s1.12-2 2.5-2 2.5.895 2.5 2" />
          <path fill-rule="evenodd" d="M12 3v10h-1V3z" />
          <path d="M11 2.82a1 1 0 0 1 .804-.98l3-.6A1 1 0 0 1 16 2.22V4l-5 1z" />
          <path fill-rule="evenodd" d="M0 11.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5m0-4A.5.5 0 0 1 .5 7H8a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5m0-4A.5.5 0 0 1 .5 3H8a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5" />
        </svg></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link <?= esLaUrl('/') ? 'active' : ''?>" aria-current="page" href="/">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= esLaUrl('/notas') ? 'active' : ''?>" href="/notas">Notas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= esLaUrl('/info') ? 'active' : ''?>" href="/info">Informacion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= esLaUrl('/contacto') ? 'active' : ''?>" href="/contacto">Contacto</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>