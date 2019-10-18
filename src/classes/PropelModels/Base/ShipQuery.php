<?php

namespace PropelModels\Base;

use \Exception;
use \PDO;
use PropelModels\Ship as ChildShip;
use PropelModels\ShipQuery as ChildShipQuery;
use PropelModels\Map\ShipTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'ship' table.
 *
 *
 *
 * @method     ChildShipQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildShipQuery orderByIdFleet($order = Criteria::ASC) Order by the id_fleet column
 * @method     ChildShipQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildShipQuery orderByLength($order = Criteria::ASC) Order by the length column
 * @method     ChildShipQuery orderByStartx($order = Criteria::ASC) Order by the startX column
 * @method     ChildShipQuery orderByStarty($order = Criteria::ASC) Order by the startY column
 * @method     ChildShipQuery orderByDirection($order = Criteria::ASC) Order by the direction column
 * @method     ChildShipQuery orderByCoordinates($order = Criteria::ASC) Order by the coordinates column
 *
 * @method     ChildShipQuery groupById() Group by the id column
 * @method     ChildShipQuery groupByIdFleet() Group by the id_fleet column
 * @method     ChildShipQuery groupByType() Group by the type column
 * @method     ChildShipQuery groupByLength() Group by the length column
 * @method     ChildShipQuery groupByStartx() Group by the startX column
 * @method     ChildShipQuery groupByStarty() Group by the startY column
 * @method     ChildShipQuery groupByDirection() Group by the direction column
 * @method     ChildShipQuery groupByCoordinates() Group by the coordinates column
 *
 * @method     ChildShipQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildShipQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildShipQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildShipQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildShipQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildShipQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildShipQuery leftJoinFleet($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fleet relation
 * @method     ChildShipQuery rightJoinFleet($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fleet relation
 * @method     ChildShipQuery innerJoinFleet($relationAlias = null) Adds a INNER JOIN clause to the query using the Fleet relation
 *
 * @method     ChildShipQuery joinWithFleet($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Fleet relation
 *
 * @method     ChildShipQuery leftJoinWithFleet() Adds a LEFT JOIN clause and with to the query using the Fleet relation
 * @method     ChildShipQuery rightJoinWithFleet() Adds a RIGHT JOIN clause and with to the query using the Fleet relation
 * @method     ChildShipQuery innerJoinWithFleet() Adds a INNER JOIN clause and with to the query using the Fleet relation
 *
 * @method     \PropelModels\FleetQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildShip findOne(ConnectionInterface $con = null) Return the first ChildShip matching the query
 * @method     ChildShip findOneOrCreate(ConnectionInterface $con = null) Return the first ChildShip matching the query, or a new ChildShip object populated from the query conditions when no match is found
 *
 * @method     ChildShip findOneById(int $id) Return the first ChildShip filtered by the id column
 * @method     ChildShip findOneByIdFleet(int $id_fleet) Return the first ChildShip filtered by the id_fleet column
 * @method     ChildShip findOneByType(string $type) Return the first ChildShip filtered by the type column
 * @method     ChildShip findOneByLength(int $length) Return the first ChildShip filtered by the length column
 * @method     ChildShip findOneByStartx(int $startX) Return the first ChildShip filtered by the startX column
 * @method     ChildShip findOneByStarty(int $startY) Return the first ChildShip filtered by the startY column
 * @method     ChildShip findOneByDirection(string $direction) Return the first ChildShip filtered by the direction column
 * @method     ChildShip findOneByCoordinates(string $coordinates) Return the first ChildShip filtered by the coordinates column *

 * @method     ChildShip requirePk($key, ConnectionInterface $con = null) Return the ChildShip by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShip requireOne(ConnectionInterface $con = null) Return the first ChildShip matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShip requireOneById(int $id) Return the first ChildShip filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShip requireOneByIdFleet(int $id_fleet) Return the first ChildShip filtered by the id_fleet column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShip requireOneByType(string $type) Return the first ChildShip filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShip requireOneByLength(int $length) Return the first ChildShip filtered by the length column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShip requireOneByStartx(int $startX) Return the first ChildShip filtered by the startX column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShip requireOneByStarty(int $startY) Return the first ChildShip filtered by the startY column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShip requireOneByDirection(string $direction) Return the first ChildShip filtered by the direction column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShip requireOneByCoordinates(string $coordinates) Return the first ChildShip filtered by the coordinates column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShip[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildShip objects based on current ModelCriteria
 * @method     ChildShip[]|ObjectCollection findById(int $id) Return ChildShip objects filtered by the id column
 * @method     ChildShip[]|ObjectCollection findByIdFleet(int $id_fleet) Return ChildShip objects filtered by the id_fleet column
 * @method     ChildShip[]|ObjectCollection findByType(string $type) Return ChildShip objects filtered by the type column
 * @method     ChildShip[]|ObjectCollection findByLength(int $length) Return ChildShip objects filtered by the length column
 * @method     ChildShip[]|ObjectCollection findByStartx(int $startX) Return ChildShip objects filtered by the startX column
 * @method     ChildShip[]|ObjectCollection findByStarty(int $startY) Return ChildShip objects filtered by the startY column
 * @method     ChildShip[]|ObjectCollection findByDirection(string $direction) Return ChildShip objects filtered by the direction column
 * @method     ChildShip[]|ObjectCollection findByCoordinates(string $coordinates) Return ChildShip objects filtered by the coordinates column
 * @method     ChildShip[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ShipQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \PropelModels\Base\ShipQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'battleship', $modelName = '\\PropelModels\\Ship', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildShipQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildShipQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildShipQuery) {
            return $criteria;
        }
        $query = new ChildShipQuery();
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
     * @return ChildShip|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ShipTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ShipTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildShip A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_fleet, type, length, startX, startY, direction, coordinates FROM ship WHERE id = :p0';
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
            /** @var ChildShip $obj */
            $obj = new ChildShip();
            $obj->hydrate($row);
            ShipTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildShip|array|mixed the result, formatted by the current formatter
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
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
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
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildShipQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ShipTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildShipQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ShipTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ShipTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ShipTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_fleet column
     *
     * Example usage:
     * <code>
     * $query->filterByIdFleet(1234); // WHERE id_fleet = 1234
     * $query->filterByIdFleet(array(12, 34)); // WHERE id_fleet IN (12, 34)
     * $query->filterByIdFleet(array('min' => 12)); // WHERE id_fleet > 12
     * </code>
     *
     * @see       filterByFleet()
     *
     * @param     mixed $idFleet The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipQuery The current query, for fluid interface
     */
    public function filterByIdFleet($idFleet = null, $comparison = null)
    {
        if (is_array($idFleet)) {
            $useMinMax = false;
            if (isset($idFleet['min'])) {
                $this->addUsingAlias(ShipTableMap::COL_ID_FLEET, $idFleet['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idFleet['max'])) {
                $this->addUsingAlias(ShipTableMap::COL_ID_FLEET, $idFleet['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipTableMap::COL_ID_FLEET, $idFleet, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the length column
     *
     * Example usage:
     * <code>
     * $query->filterByLength(1234); // WHERE length = 1234
     * $query->filterByLength(array(12, 34)); // WHERE length IN (12, 34)
     * $query->filterByLength(array('min' => 12)); // WHERE length > 12
     * </code>
     *
     * @param     mixed $length The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipQuery The current query, for fluid interface
     */
    public function filterByLength($length = null, $comparison = null)
    {
        if (is_array($length)) {
            $useMinMax = false;
            if (isset($length['min'])) {
                $this->addUsingAlias(ShipTableMap::COL_LENGTH, $length['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($length['max'])) {
                $this->addUsingAlias(ShipTableMap::COL_LENGTH, $length['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipTableMap::COL_LENGTH, $length, $comparison);
    }

    /**
     * Filter the query on the startX column
     *
     * Example usage:
     * <code>
     * $query->filterByStartx(1234); // WHERE startX = 1234
     * $query->filterByStartx(array(12, 34)); // WHERE startX IN (12, 34)
     * $query->filterByStartx(array('min' => 12)); // WHERE startX > 12
     * </code>
     *
     * @param     mixed $startx The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipQuery The current query, for fluid interface
     */
    public function filterByStartx($startx = null, $comparison = null)
    {
        if (is_array($startx)) {
            $useMinMax = false;
            if (isset($startx['min'])) {
                $this->addUsingAlias(ShipTableMap::COL_STARTX, $startx['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startx['max'])) {
                $this->addUsingAlias(ShipTableMap::COL_STARTX, $startx['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipTableMap::COL_STARTX, $startx, $comparison);
    }

    /**
     * Filter the query on the startY column
     *
     * Example usage:
     * <code>
     * $query->filterByStarty(1234); // WHERE startY = 1234
     * $query->filterByStarty(array(12, 34)); // WHERE startY IN (12, 34)
     * $query->filterByStarty(array('min' => 12)); // WHERE startY > 12
     * </code>
     *
     * @param     mixed $starty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipQuery The current query, for fluid interface
     */
    public function filterByStarty($starty = null, $comparison = null)
    {
        if (is_array($starty)) {
            $useMinMax = false;
            if (isset($starty['min'])) {
                $this->addUsingAlias(ShipTableMap::COL_STARTY, $starty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($starty['max'])) {
                $this->addUsingAlias(ShipTableMap::COL_STARTY, $starty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipTableMap::COL_STARTY, $starty, $comparison);
    }

    /**
     * Filter the query on the direction column
     *
     * Example usage:
     * <code>
     * $query->filterByDirection('fooValue');   // WHERE direction = 'fooValue'
     * $query->filterByDirection('%fooValue%', Criteria::LIKE); // WHERE direction LIKE '%fooValue%'
     * </code>
     *
     * @param     string $direction The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipQuery The current query, for fluid interface
     */
    public function filterByDirection($direction = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($direction)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipTableMap::COL_DIRECTION, $direction, $comparison);
    }

    /**
     * Filter the query on the coordinates column
     *
     * Example usage:
     * <code>
     * $query->filterByCoordinates('fooValue');   // WHERE coordinates = 'fooValue'
     * $query->filterByCoordinates('%fooValue%', Criteria::LIKE); // WHERE coordinates LIKE '%fooValue%'
     * </code>
     *
     * @param     string $coordinates The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipQuery The current query, for fluid interface
     */
    public function filterByCoordinates($coordinates = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($coordinates)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipTableMap::COL_COORDINATES, $coordinates, $comparison);
    }

    /**
     * Filter the query by a related \PropelModels\Fleet object
     *
     * @param \PropelModels\Fleet|ObjectCollection $fleet The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildShipQuery The current query, for fluid interface
     */
    public function filterByFleet($fleet, $comparison = null)
    {
        if ($fleet instanceof \PropelModels\Fleet) {
            return $this
                ->addUsingAlias(ShipTableMap::COL_ID_FLEET, $fleet->getId(), $comparison);
        } elseif ($fleet instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ShipTableMap::COL_ID_FLEET, $fleet->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByFleet() only accepts arguments of type \PropelModels\Fleet or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Fleet relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildShipQuery The current query, for fluid interface
     */
    public function joinFleet($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Fleet');

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
            $this->addJoinObject($join, 'Fleet');
        }

        return $this;
    }

    /**
     * Use the Fleet relation Fleet object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PropelModels\FleetQuery A secondary query class using the current class as primary query
     */
    public function useFleetQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFleet($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Fleet', '\PropelModels\FleetQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildShip $ship Object to remove from the list of results
     *
     * @return $this|ChildShipQuery The current query, for fluid interface
     */
    public function prune($ship = null)
    {
        if ($ship) {
            $this->addUsingAlias(ShipTableMap::COL_ID, $ship->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ship table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShipTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ShipTableMap::clearInstancePool();
            ShipTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShipTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ShipTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ShipTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ShipTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ShipQuery
