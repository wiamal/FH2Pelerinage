@extends('dashboard.dashboard')
@section('content')

<div class="container ms-auto w-50 mt-3">
    <div class="card border-1 shadow-sm ">
        <div class="card-header text-center">
            <h5>Changez votre Mot de passe</h5>
        </div>
        <div class="card-body">
            <p class="login-box-msg">
                Introduisez votre mot de passe  actuel,ensuite procédez à la saisie du nouveau
            </p>
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif 
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            

            <form  method="POST" action="{{route('dashboard.profil.changePassword')}}">
                @csrf
                @method('PUT')
                <div class="input-group mb-3">
                    
                    <input type="password"  class="form-control" name="current_password" id="current_password" placeholder="Mot de passe actuel" value="{{ old('current_password') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-eye" id="togglePassword"></span>
                        </div>
                    </div>
                    @error('current_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
    
                        <input id="password" type="password"  placeholder="Nouveau mot de passe" name="new_password" class=" form-control @error('new_password') is-invalid @enderror" required />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('new_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>

                <div class="input-group mb-3">

                        <input id="new_password_confirm" type="password" placeholder="Confirmer votre nouveau mot de passe" class="form-control" name="new_password_confirmation" required />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success btn-block">Valider</button>
                    </div>

                </div>
            </form>
        </div>

    </div>
</div>





<script type="text/javascript">
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#current_password');
    togglePassword.addEventListener('click', function (e) {
      // toggle the type attribute
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      // toggle the eye slash icon
      this.classList.toggle('fa-eye-slash');
  });
</script>





@endsection