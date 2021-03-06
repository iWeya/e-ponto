<?php

namespace App\Contracts;

interface AcademicSystemClientInterface
{
    /**
     * Coleta os dados do usuário no sistema.
     *
     * @return array|bool Dados do usuário ou false em caso de erro.
     **/
    public function getUserData (): array;

    /**
     * Faz logout no sistema, revogando o token de acesso.
     **/
    public function logout ();
}
