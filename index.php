<?php
session_start();
session_destroy();
include('includes/headbar_index.php');
?>

<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Login</div>
          <div class="card-body">
            <form action="login.php" method="POST" id="loginForm">
              <div class="form-group">
                <label for="login">CPF</label>
                <input type="text" class="form-control" id="login" placeholder="Entre com o CPF" name="user" oninput="formatarCPF(this)" required>
              </div>
              <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" id="senha" placeholder="Entre com a senha" name="password" required>
              </div>
              <input type="submit" class="btn btn-primary btn-block" value="Entrar">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para exibir mensagem de credenciais incorretas -->
  <div class="modal fade" id="loginErrorModal" tabindex="-1" role="dialog" aria-labelledby="loginErrorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginErrorModalLabel">
            Erro de Login!
            <i class="fasfa-times-circle"></i>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body">
          <p>Nome de usuário ou senha incorretos. Por favor, tente novamente.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      <?php if (isset($_GET['login_error'])) : ?>
        $('#loginErrorModal').modal('show');
      <?php endif; ?>
    });
  </script>
      <script>
        function formatarCPF(input) {
            // Remove todos os caracteres que não sejam dígitos
            var cpf = input.value.replace(/\D/g, '');

            // Aplica a formatação de acordo com a quantidade de caracteres digitados
            if (cpf.length > 9) {
                cpf = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
            } else if (cpf.length > 6) {
                cpf = cpf.replace(/(\d{3})(\d{3})(\d{3})/, '$1.$2.$3');
            } else if (cpf.length > 3) {
                cpf = cpf.replace(/(\d{3})(\d{3})/, '$1.$2');
            }

            // Atualiza o valor do input com o CPF formatado
            input.value = cpf;
        }
    </script>
</body>

</html>