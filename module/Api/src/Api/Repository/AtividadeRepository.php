<?php
namespace Api\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * AtividadeRepository
 * Classe que mantém métodos customizados de filtro
 * findAll()
 * findBy()
 * findById()
 * @author DiegoWagner
 */
class AtividadeRepository extends EntityRepository
{
    /**
     * @method getMaxIndice()
     * Retorna o último indice + 1
     * Este método é usado principalmente no Service Manager para inserir um novo indice
     * @return int $indice;
     */
    public function getLastIndice()
    {
        $query = $this->createQueryBuilder('a')
            ->select('MAX(a.indice) + 1 as indice')
            ->from($this->getEntityName(), 'ativ');

        $indice = $query->getQuery()->getSingleScalarResult();
        return $indice;
    }
}