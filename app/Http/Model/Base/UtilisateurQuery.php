<?php

namespace App\Http\Model\Base;

use \Exception;
use \PDO;
use App\Http\Model\Utilisateur as ChildUtilisateur;
use App\Http\Model\UtilisateurQuery as ChildUtilisateurQuery;
use App\Http\Model\Map\UtilisateurTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `utilisateur` table.
 *
 * @method     ChildUtilisateurQuery orderByCodeutilisateur($order = Criteria::ASC) Order by the codeUtilisateur column
 * @method     ChildUtilisateurQuery orderByRaisonsociale($order = Criteria::ASC) Order by the raisonSociale column
 * @method     ChildUtilisateurQuery orderByAdresse($order = Criteria::ASC) Order by the adresse column
 * @method     ChildUtilisateurQuery orderByCp($order = Criteria::ASC) Order by the cp column
 * @method     ChildUtilisateurQuery orderByVille($order = Criteria::ASC) Order by the ville column
 * @method     ChildUtilisateurQuery orderByAdrmel($order = Criteria::ASC) Order by the adrMel column
 * @method     ChildUtilisateurQuery orderByTelephone($order = Criteria::ASC) Order by the telephone column
 * @method     ChildUtilisateurQuery orderByContact($order = Criteria::ASC) Order by the contact column
 * @method     ChildUtilisateurQuery orderByCodepays($order = Criteria::ASC) Order by the codePays column
 * @method     ChildUtilisateurQuery orderByIdentifiant($order = Criteria::ASC) Order by the identifiant column
 * @method     ChildUtilisateurQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildUtilisateurQuery orderByProfil($order = Criteria::ASC) Order by the profil column
 * @method     ChildUtilisateurQuery orderByNombredetentativesdeconnexion($order = Criteria::ASC) Order by the nombreDeTentativesDeConnexion column
 * @method     ChildUtilisateurQuery orderByDernieretentativedeconnexionnonvalide($order = Criteria::ASC) Order by the derniereTentativeDeConnexionNonValide column
 *
 * @method     ChildUtilisateurQuery groupByCodeutilisateur() Group by the codeUtilisateur column
 * @method     ChildUtilisateurQuery groupByRaisonsociale() Group by the raisonSociale column
 * @method     ChildUtilisateurQuery groupByAdresse() Group by the adresse column
 * @method     ChildUtilisateurQuery groupByCp() Group by the cp column
 * @method     ChildUtilisateurQuery groupByVille() Group by the ville column
 * @method     ChildUtilisateurQuery groupByAdrmel() Group by the adrMel column
 * @method     ChildUtilisateurQuery groupByTelephone() Group by the telephone column
 * @method     ChildUtilisateurQuery groupByContact() Group by the contact column
 * @method     ChildUtilisateurQuery groupByCodepays() Group by the codePays column
 * @method     ChildUtilisateurQuery groupByIdentifiant() Group by the identifiant column
 * @method     ChildUtilisateurQuery groupByPassword() Group by the password column
 * @method     ChildUtilisateurQuery groupByProfil() Group by the profil column
 * @method     ChildUtilisateurQuery groupByNombredetentativesdeconnexion() Group by the nombreDeTentativesDeConnexion column
 * @method     ChildUtilisateurQuery groupByDernieretentativedeconnexionnonvalide() Group by the derniereTentativeDeConnexionNonValide column
 *
 * @method     ChildUtilisateurQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUtilisateurQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUtilisateurQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUtilisateurQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUtilisateurQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUtilisateurQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUtilisateurQuery leftJoinPays($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pays relation
 * @method     ChildUtilisateurQuery rightJoinPays($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pays relation
 * @method     ChildUtilisateurQuery innerJoinPays($relationAlias = null) Adds a INNER JOIN clause to the query using the Pays relation
 *
 * @method     ChildUtilisateurQuery joinWithPays($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Pays relation
 *
 * @method     ChildUtilisateurQuery leftJoinWithPays() Adds a LEFT JOIN clause and with to the query using the Pays relation
 * @method     ChildUtilisateurQuery rightJoinWithPays() Adds a RIGHT JOIN clause and with to the query using the Pays relation
 * @method     ChildUtilisateurQuery innerJoinWithPays() Adds a INNER JOIN clause and with to the query using the Pays relation
 *
 * @method     ChildUtilisateurQuery leftJoinReservation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Reservation relation
 * @method     ChildUtilisateurQuery rightJoinReservation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Reservation relation
 * @method     ChildUtilisateurQuery innerJoinReservation($relationAlias = null) Adds a INNER JOIN clause to the query using the Reservation relation
 *
 * @method     ChildUtilisateurQuery joinWithReservation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Reservation relation
 *
 * @method     ChildUtilisateurQuery leftJoinWithReservation() Adds a LEFT JOIN clause and with to the query using the Reservation relation
 * @method     ChildUtilisateurQuery rightJoinWithReservation() Adds a RIGHT JOIN clause and with to the query using the Reservation relation
 * @method     ChildUtilisateurQuery innerJoinWithReservation() Adds a INNER JOIN clause and with to the query using the Reservation relation
 *
 * @method     \App\Http\Model\PaysQuery|\App\Http\Model\ReservationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUtilisateur|null findOne(?ConnectionInterface $con = null) Return the first ChildUtilisateur matching the query
 * @method     ChildUtilisateur findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildUtilisateur matching the query, or a new ChildUtilisateur object populated from the query conditions when no match is found
 *
 * @method     ChildUtilisateur|null findOneByCodeutilisateur(int $codeUtilisateur) Return the first ChildUtilisateur filtered by the codeUtilisateur column
 * @method     ChildUtilisateur|null findOneByRaisonsociale(string $raisonSociale) Return the first ChildUtilisateur filtered by the raisonSociale column
 * @method     ChildUtilisateur|null findOneByAdresse(string $adresse) Return the first ChildUtilisateur filtered by the adresse column
 * @method     ChildUtilisateur|null findOneByCp(string $cp) Return the first ChildUtilisateur filtered by the cp column
 * @method     ChildUtilisateur|null findOneByVille(string $ville) Return the first ChildUtilisateur filtered by the ville column
 * @method     ChildUtilisateur|null findOneByAdrmel(string $adrMel) Return the first ChildUtilisateur filtered by the adrMel column
 * @method     ChildUtilisateur|null findOneByTelephone(string $telephone) Return the first ChildUtilisateur filtered by the telephone column
 * @method     ChildUtilisateur|null findOneByContact(string $contact) Return the first ChildUtilisateur filtered by the contact column
 * @method     ChildUtilisateur|null findOneByCodepays(string $codePays) Return the first ChildUtilisateur filtered by the codePays column
 * @method     ChildUtilisateur|null findOneByIdentifiant(string $identifiant) Return the first ChildUtilisateur filtered by the identifiant column
 * @method     ChildUtilisateur|null findOneByPassword(string $password) Return the first ChildUtilisateur filtered by the password column
 * @method     ChildUtilisateur|null findOneByProfil(string $profil) Return the first ChildUtilisateur filtered by the profil column
 * @method     ChildUtilisateur|null findOneByNombredetentativesdeconnexion(int $nombreDeTentativesDeConnexion) Return the first ChildUtilisateur filtered by the nombreDeTentativesDeConnexion column
 * @method     ChildUtilisateur|null findOneByDernieretentativedeconnexionnonvalide(string $derniereTentativeDeConnexionNonValide) Return the first ChildUtilisateur filtered by the derniereTentativeDeConnexionNonValide column
 *
 * @method     ChildUtilisateur requirePk($key, ?ConnectionInterface $con = null) Return the ChildUtilisateur by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOne(?ConnectionInterface $con = null) Return the first ChildUtilisateur matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUtilisateur requireOneByCodeutilisateur(int $codeUtilisateur) Return the first ChildUtilisateur filtered by the codeUtilisateur column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOneByRaisonsociale(string $raisonSociale) Return the first ChildUtilisateur filtered by the raisonSociale column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOneByAdresse(string $adresse) Return the first ChildUtilisateur filtered by the adresse column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOneByCp(string $cp) Return the first ChildUtilisateur filtered by the cp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOneByVille(string $ville) Return the first ChildUtilisateur filtered by the ville column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOneByAdrmel(string $adrMel) Return the first ChildUtilisateur filtered by the adrMel column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOneByTelephone(string $telephone) Return the first ChildUtilisateur filtered by the telephone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOneByContact(string $contact) Return the first ChildUtilisateur filtered by the contact column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOneByCodepays(string $codePays) Return the first ChildUtilisateur filtered by the codePays column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOneByIdentifiant(string $identifiant) Return the first ChildUtilisateur filtered by the identifiant column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOneByPassword(string $password) Return the first ChildUtilisateur filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOneByProfil(string $profil) Return the first ChildUtilisateur filtered by the profil column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOneByNombredetentativesdeconnexion(int $nombreDeTentativesDeConnexion) Return the first ChildUtilisateur filtered by the nombreDeTentativesDeConnexion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOneByDernieretentativedeconnexionnonvalide(string $derniereTentativeDeConnexionNonValide) Return the first ChildUtilisateur filtered by the derniereTentativeDeConnexionNonValide column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUtilisateur[]|Collection find(?ConnectionInterface $con = null) Return ChildUtilisateur objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildUtilisateur> find(?ConnectionInterface $con = null) Return ChildUtilisateur objects based on current ModelCriteria
 *
 * @method     ChildUtilisateur[]|Collection findByCodeutilisateur(int|array<int> $codeUtilisateur) Return ChildUtilisateur objects filtered by the codeUtilisateur column
 * @psalm-method Collection&\Traversable<ChildUtilisateur> findByCodeutilisateur(int|array<int> $codeUtilisateur) Return ChildUtilisateur objects filtered by the codeUtilisateur column
 * @method     ChildUtilisateur[]|Collection findByRaisonsociale(string|array<string> $raisonSociale) Return ChildUtilisateur objects filtered by the raisonSociale column
 * @psalm-method Collection&\Traversable<ChildUtilisateur> findByRaisonsociale(string|array<string> $raisonSociale) Return ChildUtilisateur objects filtered by the raisonSociale column
 * @method     ChildUtilisateur[]|Collection findByAdresse(string|array<string> $adresse) Return ChildUtilisateur objects filtered by the adresse column
 * @psalm-method Collection&\Traversable<ChildUtilisateur> findByAdresse(string|array<string> $adresse) Return ChildUtilisateur objects filtered by the adresse column
 * @method     ChildUtilisateur[]|Collection findByCp(string|array<string> $cp) Return ChildUtilisateur objects filtered by the cp column
 * @psalm-method Collection&\Traversable<ChildUtilisateur> findByCp(string|array<string> $cp) Return ChildUtilisateur objects filtered by the cp column
 * @method     ChildUtilisateur[]|Collection findByVille(string|array<string> $ville) Return ChildUtilisateur objects filtered by the ville column
 * @psalm-method Collection&\Traversable<ChildUtilisateur> findByVille(string|array<string> $ville) Return ChildUtilisateur objects filtered by the ville column
 * @method     ChildUtilisateur[]|Collection findByAdrmel(string|array<string> $adrMel) Return ChildUtilisateur objects filtered by the adrMel column
 * @psalm-method Collection&\Traversable<ChildUtilisateur> findByAdrmel(string|array<string> $adrMel) Return ChildUtilisateur objects filtered by the adrMel column
 * @method     ChildUtilisateur[]|Collection findByTelephone(string|array<string> $telephone) Return ChildUtilisateur objects filtered by the telephone column
 * @psalm-method Collection&\Traversable<ChildUtilisateur> findByTelephone(string|array<string> $telephone) Return ChildUtilisateur objects filtered by the telephone column
 * @method     ChildUtilisateur[]|Collection findByContact(string|array<string> $contact) Return ChildUtilisateur objects filtered by the contact column
 * @psalm-method Collection&\Traversable<ChildUtilisateur> findByContact(string|array<string> $contact) Return ChildUtilisateur objects filtered by the contact column
 * @method     ChildUtilisateur[]|Collection findByCodepays(string|array<string> $codePays) Return ChildUtilisateur objects filtered by the codePays column
 * @psalm-method Collection&\Traversable<ChildUtilisateur> findByCodepays(string|array<string> $codePays) Return ChildUtilisateur objects filtered by the codePays column
 * @method     ChildUtilisateur[]|Collection findByIdentifiant(string|array<string> $identifiant) Return ChildUtilisateur objects filtered by the identifiant column
 * @psalm-method Collection&\Traversable<ChildUtilisateur> findByIdentifiant(string|array<string> $identifiant) Return ChildUtilisateur objects filtered by the identifiant column
 * @method     ChildUtilisateur[]|Collection findByPassword(string|array<string> $password) Return ChildUtilisateur objects filtered by the password column
 * @psalm-method Collection&\Traversable<ChildUtilisateur> findByPassword(string|array<string> $password) Return ChildUtilisateur objects filtered by the password column
 * @method     ChildUtilisateur[]|Collection findByProfil(string|array<string> $profil) Return ChildUtilisateur objects filtered by the profil column
 * @psalm-method Collection&\Traversable<ChildUtilisateur> findByProfil(string|array<string> $profil) Return ChildUtilisateur objects filtered by the profil column
 * @method     ChildUtilisateur[]|Collection findByNombredetentativesdeconnexion(int|array<int> $nombreDeTentativesDeConnexion) Return ChildUtilisateur objects filtered by the nombreDeTentativesDeConnexion column
 * @psalm-method Collection&\Traversable<ChildUtilisateur> findByNombredetentativesdeconnexion(int|array<int> $nombreDeTentativesDeConnexion) Return ChildUtilisateur objects filtered by the nombreDeTentativesDeConnexion column
 * @method     ChildUtilisateur[]|Collection findByDernieretentativedeconnexionnonvalide(string|array<string> $derniereTentativeDeConnexionNonValide) Return ChildUtilisateur objects filtered by the derniereTentativeDeConnexionNonValide column
 * @psalm-method Collection&\Traversable<ChildUtilisateur> findByDernieretentativedeconnexionnonvalide(string|array<string> $derniereTentativeDeConnexionNonValide) Return ChildUtilisateur objects filtered by the derniereTentativeDeConnexionNonValide column
 *
 * @method     ChildUtilisateur[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildUtilisateur> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class UtilisateurQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Http\Model\Base\UtilisateurQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Http\\Model\\Utilisateur', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUtilisateurQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUtilisateurQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildUtilisateurQuery) {
            return $criteria;
        }
        $query = new ChildUtilisateurQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildUtilisateur|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UtilisateurTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UtilisateurTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUtilisateur A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT codeUtilisateur, raisonSociale, adresse, cp, ville, adrMel, telephone, contact, codePays, identifiant, password, profil, nombreDeTentativesDeConnexion, derniereTentativeDeConnexionNonValide FROM utilisateur WHERE codeUtilisateur = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildUtilisateur $obj */
            $obj = new ChildUtilisateur();
            $obj->hydrate($row);
            UtilisateurTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildUtilisateur|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(UtilisateurTableMap::COL_CODEUTILISATEUR, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(UtilisateurTableMap::COL_CODEUTILISATEUR, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the codeUtilisateur column
     *
     * Example usage:
     * <code>
     * $query->filterByCodeutilisateur(1234); // WHERE codeUtilisateur = 1234
     * $query->filterByCodeutilisateur(array(12, 34)); // WHERE codeUtilisateur IN (12, 34)
     * $query->filterByCodeutilisateur(array('min' => 12)); // WHERE codeUtilisateur > 12
     * </code>
     *
     * @param mixed $codeutilisateur The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCodeutilisateur($codeutilisateur = null, ?string $comparison = null)
    {
        if (is_array($codeutilisateur)) {
            $useMinMax = false;
            if (isset($codeutilisateur['min'])) {
                $this->addUsingAlias(UtilisateurTableMap::COL_CODEUTILISATEUR, $codeutilisateur['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($codeutilisateur['max'])) {
                $this->addUsingAlias(UtilisateurTableMap::COL_CODEUTILISATEUR, $codeutilisateur['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UtilisateurTableMap::COL_CODEUTILISATEUR, $codeutilisateur, $comparison);

        return $this;
    }

    /**
     * Filter the query on the raisonSociale column
     *
     * Example usage:
     * <code>
     * $query->filterByRaisonsociale('fooValue');   // WHERE raisonSociale = 'fooValue'
     * $query->filterByRaisonsociale('%fooValue%', Criteria::LIKE); // WHERE raisonSociale LIKE '%fooValue%'
     * $query->filterByRaisonsociale(['foo', 'bar']); // WHERE raisonSociale IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $raisonsociale The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRaisonsociale($raisonsociale = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($raisonsociale)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UtilisateurTableMap::COL_RAISONSOCIALE, $raisonsociale, $comparison);

        return $this;
    }

    /**
     * Filter the query on the adresse column
     *
     * Example usage:
     * <code>
     * $query->filterByAdresse('fooValue');   // WHERE adresse = 'fooValue'
     * $query->filterByAdresse('%fooValue%', Criteria::LIKE); // WHERE adresse LIKE '%fooValue%'
     * $query->filterByAdresse(['foo', 'bar']); // WHERE adresse IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $adresse The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAdresse($adresse = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($adresse)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UtilisateurTableMap::COL_ADRESSE, $adresse, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cp column
     *
     * Example usage:
     * <code>
     * $query->filterByCp('fooValue');   // WHERE cp = 'fooValue'
     * $query->filterByCp('%fooValue%', Criteria::LIKE); // WHERE cp LIKE '%fooValue%'
     * $query->filterByCp(['foo', 'bar']); // WHERE cp IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $cp The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCp($cp = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cp)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UtilisateurTableMap::COL_CP, $cp, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ville column
     *
     * Example usage:
     * <code>
     * $query->filterByVille('fooValue');   // WHERE ville = 'fooValue'
     * $query->filterByVille('%fooValue%', Criteria::LIKE); // WHERE ville LIKE '%fooValue%'
     * $query->filterByVille(['foo', 'bar']); // WHERE ville IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $ville The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVille($ville = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ville)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UtilisateurTableMap::COL_VILLE, $ville, $comparison);

        return $this;
    }

    /**
     * Filter the query on the adrMel column
     *
     * Example usage:
     * <code>
     * $query->filterByAdrmel('fooValue');   // WHERE adrMel = 'fooValue'
     * $query->filterByAdrmel('%fooValue%', Criteria::LIKE); // WHERE adrMel LIKE '%fooValue%'
     * $query->filterByAdrmel(['foo', 'bar']); // WHERE adrMel IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $adrmel The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAdrmel($adrmel = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($adrmel)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UtilisateurTableMap::COL_ADRMEL, $adrmel, $comparison);

        return $this;
    }

    /**
     * Filter the query on the telephone column
     *
     * Example usage:
     * <code>
     * $query->filterByTelephone('fooValue');   // WHERE telephone = 'fooValue'
     * $query->filterByTelephone('%fooValue%', Criteria::LIKE); // WHERE telephone LIKE '%fooValue%'
     * $query->filterByTelephone(['foo', 'bar']); // WHERE telephone IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $telephone The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTelephone($telephone = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telephone)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UtilisateurTableMap::COL_TELEPHONE, $telephone, $comparison);

        return $this;
    }

    /**
     * Filter the query on the contact column
     *
     * Example usage:
     * <code>
     * $query->filterByContact('fooValue');   // WHERE contact = 'fooValue'
     * $query->filterByContact('%fooValue%', Criteria::LIKE); // WHERE contact LIKE '%fooValue%'
     * $query->filterByContact(['foo', 'bar']); // WHERE contact IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $contact The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByContact($contact = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contact)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UtilisateurTableMap::COL_CONTACT, $contact, $comparison);

        return $this;
    }

    /**
     * Filter the query on the codePays column
     *
     * Example usage:
     * <code>
     * $query->filterByCodepays('fooValue');   // WHERE codePays = 'fooValue'
     * $query->filterByCodepays('%fooValue%', Criteria::LIKE); // WHERE codePays LIKE '%fooValue%'
     * $query->filterByCodepays(['foo', 'bar']); // WHERE codePays IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $codepays The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCodepays($codepays = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codepays)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UtilisateurTableMap::COL_CODEPAYS, $codepays, $comparison);

        return $this;
    }

    /**
     * Filter the query on the identifiant column
     *
     * Example usage:
     * <code>
     * $query->filterByIdentifiant('fooValue');   // WHERE identifiant = 'fooValue'
     * $query->filterByIdentifiant('%fooValue%', Criteria::LIKE); // WHERE identifiant LIKE '%fooValue%'
     * $query->filterByIdentifiant(['foo', 'bar']); // WHERE identifiant IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $identifiant The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdentifiant($identifiant = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($identifiant)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UtilisateurTableMap::COL_IDENTIFIANT, $identifiant, $comparison);

        return $this;
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%', Criteria::LIKE); // WHERE password LIKE '%fooValue%'
     * $query->filterByPassword(['foo', 'bar']); // WHERE password IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $password The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPassword($password = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UtilisateurTableMap::COL_PASSWORD, $password, $comparison);

        return $this;
    }

    /**
     * Filter the query on the profil column
     *
     * Example usage:
     * <code>
     * $query->filterByProfil('fooValue');   // WHERE profil = 'fooValue'
     * $query->filterByProfil('%fooValue%', Criteria::LIKE); // WHERE profil LIKE '%fooValue%'
     * $query->filterByProfil(['foo', 'bar']); // WHERE profil IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $profil The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProfil($profil = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($profil)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UtilisateurTableMap::COL_PROFIL, $profil, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nombreDeTentativesDeConnexion column
     *
     * Example usage:
     * <code>
     * $query->filterByNombredetentativesdeconnexion(1234); // WHERE nombreDeTentativesDeConnexion = 1234
     * $query->filterByNombredetentativesdeconnexion(array(12, 34)); // WHERE nombreDeTentativesDeConnexion IN (12, 34)
     * $query->filterByNombredetentativesdeconnexion(array('min' => 12)); // WHERE nombreDeTentativesDeConnexion > 12
     * </code>
     *
     * @param mixed $nombredetentativesdeconnexion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNombredetentativesdeconnexion($nombredetentativesdeconnexion = null, ?string $comparison = null)
    {
        if (is_array($nombredetentativesdeconnexion)) {
            $useMinMax = false;
            if (isset($nombredetentativesdeconnexion['min'])) {
                $this->addUsingAlias(UtilisateurTableMap::COL_NOMBREDETENTATIVESDECONNEXION, $nombredetentativesdeconnexion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nombredetentativesdeconnexion['max'])) {
                $this->addUsingAlias(UtilisateurTableMap::COL_NOMBREDETENTATIVESDECONNEXION, $nombredetentativesdeconnexion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UtilisateurTableMap::COL_NOMBREDETENTATIVESDECONNEXION, $nombredetentativesdeconnexion, $comparison);

        return $this;
    }

    /**
     * Filter the query on the derniereTentativeDeConnexionNonValide column
     *
     * Example usage:
     * <code>
     * $query->filterByDernieretentativedeconnexionnonvalide('2011-03-14'); // WHERE derniereTentativeDeConnexionNonValide = '2011-03-14'
     * $query->filterByDernieretentativedeconnexionnonvalide('now'); // WHERE derniereTentativeDeConnexionNonValide = '2011-03-14'
     * $query->filterByDernieretentativedeconnexionnonvalide(array('max' => 'yesterday')); // WHERE derniereTentativeDeConnexionNonValide > '2011-03-13'
     * </code>
     *
     * @param mixed $dernieretentativedeconnexionnonvalide The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDernieretentativedeconnexionnonvalide($dernieretentativedeconnexionnonvalide = null, ?string $comparison = null)
    {
        if (is_array($dernieretentativedeconnexionnonvalide)) {
            $useMinMax = false;
            if (isset($dernieretentativedeconnexionnonvalide['min'])) {
                $this->addUsingAlias(UtilisateurTableMap::COL_DERNIERETENTATIVEDECONNEXIONNONVALIDE, $dernieretentativedeconnexionnonvalide['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dernieretentativedeconnexionnonvalide['max'])) {
                $this->addUsingAlias(UtilisateurTableMap::COL_DERNIERETENTATIVEDECONNEXIONNONVALIDE, $dernieretentativedeconnexionnonvalide['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UtilisateurTableMap::COL_DERNIERETENTATIVEDECONNEXIONNONVALIDE, $dernieretentativedeconnexionnonvalide, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \App\Http\Model\Pays object
     *
     * @param \App\Http\Model\Pays|ObjectCollection $pays The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPays($pays, ?string $comparison = null)
    {
        if ($pays instanceof \App\Http\Model\Pays) {
            return $this
                ->addUsingAlias(UtilisateurTableMap::COL_CODEPAYS, $pays->getCodepays(), $comparison);
        } elseif ($pays instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(UtilisateurTableMap::COL_CODEPAYS, $pays->toKeyValue('PrimaryKey', 'Codepays'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByPays() only accepts arguments of type \App\Http\Model\Pays or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Pays relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPays(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Pays');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Pays');
        }

        return $this;
    }

    /**
     * Use the Pays relation Pays object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Http\Model\PaysQuery A secondary query class using the current class as primary query
     */
    public function usePaysQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPays($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Pays', '\App\Http\Model\PaysQuery');
    }

    /**
     * Use the Pays relation Pays object
     *
     * @param callable(\App\Http\Model\PaysQuery):\App\Http\Model\PaysQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPaysQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePaysQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Pays table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\Http\Model\PaysQuery The inner query object of the EXISTS statement
     */
    public function usePaysExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\Http\Model\PaysQuery */
        $q = $this->useExistsQuery('Pays', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Pays table for a NOT EXISTS query.
     *
     * @see usePaysExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\PaysQuery The inner query object of the NOT EXISTS statement
     */
    public function usePaysNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\PaysQuery */
        $q = $this->useExistsQuery('Pays', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Pays table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\Http\Model\PaysQuery The inner query object of the IN statement
     */
    public function useInPaysQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\Http\Model\PaysQuery */
        $q = $this->useInQuery('Pays', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Pays table for a NOT IN query.
     *
     * @see usePaysInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\PaysQuery The inner query object of the NOT IN statement
     */
    public function useNotInPaysQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\PaysQuery */
        $q = $this->useInQuery('Pays', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \App\Http\Model\Reservation object
     *
     * @param \App\Http\Model\Reservation|ObjectCollection $reservation the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReservation($reservation, ?string $comparison = null)
    {
        if ($reservation instanceof \App\Http\Model\Reservation) {
            $this
                ->addUsingAlias(UtilisateurTableMap::COL_CODEUTILISATEUR, $reservation->getCodeutilisateur(), $comparison);

            return $this;
        } elseif ($reservation instanceof ObjectCollection) {
            $this
                ->useReservationQuery()
                ->filterByPrimaryKeys($reservation->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByReservation() only accepts arguments of type \App\Http\Model\Reservation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Reservation relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinReservation(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Reservation');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Reservation');
        }

        return $this;
    }

    /**
     * Use the Reservation relation Reservation object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Http\Model\ReservationQuery A secondary query class using the current class as primary query
     */
    public function useReservationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinReservation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Reservation', '\App\Http\Model\ReservationQuery');
    }

    /**
     * Use the Reservation relation Reservation object
     *
     * @param callable(\App\Http\Model\ReservationQuery):\App\Http\Model\ReservationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withReservationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useReservationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Reservation table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\Http\Model\ReservationQuery The inner query object of the EXISTS statement
     */
    public function useReservationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\Http\Model\ReservationQuery */
        $q = $this->useExistsQuery('Reservation', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Reservation table for a NOT EXISTS query.
     *
     * @see useReservationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\ReservationQuery The inner query object of the NOT EXISTS statement
     */
    public function useReservationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\ReservationQuery */
        $q = $this->useExistsQuery('Reservation', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Reservation table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\Http\Model\ReservationQuery The inner query object of the IN statement
     */
    public function useInReservationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\Http\Model\ReservationQuery */
        $q = $this->useInQuery('Reservation', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Reservation table for a NOT IN query.
     *
     * @see useReservationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\ReservationQuery The inner query object of the NOT IN statement
     */
    public function useNotInReservationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\ReservationQuery */
        $q = $this->useInQuery('Reservation', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildUtilisateur $utilisateur Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($utilisateur = null)
    {
        if ($utilisateur) {
            $this->addUsingAlias(UtilisateurTableMap::COL_CODEUTILISATEUR, $utilisateur->getCodeutilisateur(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the utilisateur table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UtilisateurTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UtilisateurTableMap::clearInstancePool();
            UtilisateurTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UtilisateurTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UtilisateurTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UtilisateurTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UtilisateurTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
