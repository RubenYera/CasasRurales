<?php

namespace App\Repository;

use App\Entity\Alojamiento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Alojamiento|null find($id, $lockMode = null, $lockVersion = null)
 * @method Alojamiento|null findOneBy(array $criteria, array $orderBy = null)
 * @method Alojamiento[]    findAll()
 * @method Alojamiento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlojamientoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Alojamiento::class);
    }

    /**
     * @return Notas[] Returns an array of Notas medias de las valoraciones
     */
    public function valoracionesMedias(int $id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT truncate(avg(nota_limpieza),2) AS media_Limpieza, 
            truncate(avg(nota_ubicacion),2) AS media_Ubicacion,
            truncate(avg(nota_instalaciones_servicios),2) AS media_Instalaciones_Servicios FROM valoracion v
            WHERE v.alojamiento_id = :id_Alojamiento';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['id_Alojamiento' => $id]);

        $array = $resultSet->fetch();
        $array["nota_media"]=($array["media_Limpieza"]+$array["media_Ubicacion"]+$array["media_Instalaciones_Servicios"])/3;
        $array["nota_media"]=round($array["nota_media"],2);
        // returns an array of arrays (i.e. a raw data set)
        return $array;
    }

    // /**
    //  * @return Alojamiento[] Returns an array of Alojamiento objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Alojamiento
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
