<?php
/**
 * Class FlashMessages
 */
namespace Base\Enum;

abstract class FlashMessages
{
    const ERRO_INESPERADO             = 'Houve um erro inesperado, por favor, tente novamente.';
    const ERRO_PADRAO_SALVAR          = 'Houve um erro ao tentar salvar as informações enviadas, por favor, tente novamente.';
    const ERRO_PADRAO_REMOVER         = 'Houve um erro ao tentar excluir o registro, por favor, tente novamente.';
    const ERRO_PADRAO_DOWNLOAD        = 'Houve um erro ao tentar fazer o download do arquivo, por favor, tente novamente.';
    const ERRO_PADRAO_LOGIN           = 'Houve um erro ao tentar fazer o login, por favor, tente novamente.';
    const ERRO_PADRAO_LOGOUT          = 'Houve um erro ao tentar fazer o logout, por favor, tente novamente.';
    const ERRO_PADRAO_RECUPERAR_SENHA = 'Houve um erro ao tentar recuperar a senha, por favor, tente novamente.';
    const ERRO_PADRAO_LISTAR          = 'Houve um erro ao tentar listar os dados, por favor, tente novamente.';

    const SUCESSO_PADRAO_SALVAR  = 'Dados salvos com sucesso.';
    const SUCESSO_PADRAO_REMOVER = 'Dados excluídos com sucesso.';

    const MSG_RETORNO_SUCESSO = 'ID do objeto referenciado: %s';
    const MSG_RETORNO_ERROR   = 'Falha na execução da operação: %s';
    const MSG_RETORNO_ERROR_RECUPERAR_OBJETO = 'Não foi possível recuperar os dados do objeto: %s.';

    const SUCESSO_ENVIO_EMAIL = 'Email enviado com sucesso';

    const INSTANCIA_INVALIDA = 'Objeto não é uma instância de ObjectEntity';

    const CAMPO_OBRIGATORIO = 'Campos Obrigatórios';

    const ACESSO_NEGADO = 'Acesso negado!';
} 