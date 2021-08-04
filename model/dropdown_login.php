    <a href="" class="btn btn-outline-primary ms-4" data-bs-toggle="dropdown">Entrar</a>

    <!-- Dropdown Login -->

    <div class="dropdown-menu">
        <form class="px-4 py-3" method="post" action="./model/login.php" onsubmit="return login();">
            <div class="mb-3">
                <label for="Email" class="form-label">Email</label>
                <input type="email" class="form-control" id="loginEmail" required name="loginEmail" placeholder="email@exemplo.com">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="loginPassword" required name="loginPassword" placeholder="Senha">
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="dropdownCheck">
                    <label class="form-check-label" for="dropdownCheck">
                        Lembrar
                    </label>
                </div>
            </div>
            <button type="submit" id="btnEntrar" class="btn btn-primary">Entrar</button>
        </form>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#criarContaAluno" href="#">Aluno novo
            por aqui? Cadastre-se</a>
        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#criarContaProfessor" id="openCadProf" href="#">Professor novo
            por aqui? Cadastre-se</a>
        <a class="dropdown-item" href="#">Esqueceu a senha?</a>
    </div>
    <!-- Dropdown login fim -->
    
    <!-- Modal Cadastro Professor inicio -->
    <div class="modal fade" id="criarContaProfessor" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Cadastro Professor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="profCadastro" method="POST" enctype="multipart/form-data" onload="return consultaUnidade()">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" required class="form-control" id="profNome" name="profNome">
                        </div>

                        <div class="mb-3">
                            <label for="tel" class="form-label">Telefone</label>
                            <input type="tel" required class="form-control" id="profTel" name="profTel">
                        </div>

                        <div class="mb-3">
                            <label for="dtaNascimento" class="form-label">Data de Nascimento</label>
                            <input type="date" required class="form-control" id="profDtaNascimento" name="profDtaNascimento">
                        </div>

                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" required class="form-control" id="profCpf" name="profCpf">
                        </div>

                        <div class="mb-3">
                            <label for="emailcad" class="form-label">Email</label>
                            <input type="email" required class="form-control" id="profEmail" name="profEmail">
                        </div>


                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" required class="form-control" id="profSenha" name="profSenha">
                        </div>

                        <div class="mb-3">
                            <label for="unidade" class="form-label">Unidade</label>
                            <select class="form-control" required name="profUnidade" id="profUnidade">
                                <option value="">Selecione uma Unidade</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="materia" class="form-label">Materia</label>
                            <input type="text" required class="form-control" id="profMateria" name="profMateria">
                        </div>

                        <div class="mb-3">
                            <label for="lattes" class="form-label">Link Lattes</label>
                            <input type="url" class="form-control" id="profLattes" name="profLattes">
                        </div>


                        <div class="mb-3">
                            <label for="lattes" class="form-label">Descrição</label>
                            <textarea class="form-control" required name="profInfo" id="profInfo" rows="3"></textarea>
                        </div>



                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary me-auto" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal Cadastro Professor fim -->

    <!-- Modal Cadastro Aluno inicio -->
    <div class="modal fade" id="criarContaAluno" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Cadastro Aluno</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form method="POST" enctype="multipart/form-data" id="alunoCadastro">
                        <div class="mb-3">
                            <label for="nomeAluno" class="form-label">Nome</label>
                            <input type="text" required class="form-control" id="nomeAluno" name="nomeAluno">
                        </div>

                        <div class="mb-3">
                            <label for="telAluno" class="form-label">Telefone</label>
                            <input type="tel" required class="form-control" id="telAluno" name="telAluno">
                        </div>

                        <div class="mb-3">
                            <label for="dtaNascimentoAluno" class="form-label">Data de Nascimento</label>
                            <input type="date" required class="form-control" id="dtaNascimentoAluno" name="dtaNascimentoAluno">
                        </div>

                        <div class="mb-3">
                            <label for="cpfAluno" class="form-label">CPF</label>
                            <input type="text" required class="form-control" id="cpfAluno" name="cpfAluno">
                        </div>

                        <div class="mb-3">
                            <label for="emailcadAluno" class="form-label">Email</label>
                            <input type="text" required class="form-control" id="emailcadAluno" name="emailcadAluno">
                        </div>


                        <div class="mb-3">
                            <label for="senhaAluno" class="form-label">Senha</label>
                            <input type="password" required class="form-control" id="senhaAluno" name="senhaAluno">
                        </div>

                        <div class="mb-3">
                            <label for="unidadeAluno" class="form-label">Unidade</label>
                            <select class="form-control" required id="unidadeAluno" name="unidadeAluno">
                                <option>Selecione uma Unidade</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="cursoAluno" class="form-label">Curso</label>
                            <select class="form-control" required id="cursoAluno" name="cursoAluno">
                                <option>Selecione um curso</option>
                            </select>
                        </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary me-auto" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Cadastro Aluno fim -->