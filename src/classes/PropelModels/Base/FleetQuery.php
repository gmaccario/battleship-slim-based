<?php

namespace PropelModels\Base;

use \Exception;
use \PDO;
use PropelModels\Fleet as ChildFleet;
use PropelModels\FleetQuery as ChildFleetQuery;
use PropelModels\Map\FleetTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'fleet' table.
 *
 *
 *
 * @method     ChildFleetQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildFleetQuery orderByIdGame($order = Criteria::ASC) Order by the id_game column
 * @method     ChildFleetQuery orderBySide($order = Criteria::ASC) Order by the side column
 *
 * @method     ChildFleetQuery groupById() Group by the id column
 * @method     ChildFleetQuery groupByIdGame() Group by the id_game column
 * @method     ChildFleetQuery groupBySide() Group by the side column
 *
 * @method     ChildFleetQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFleetQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFleetQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFleetQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFleetQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFleetQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFleetQuery leftJoinGame($relationAlias = null) Adds a LEFT JOIN clause to the query using the Game relation
 * @method     ChildFleetQuery rightJoinGame($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Game relation
 * @method     ChildFleetQuery innerJoinGame($relationAlias = null) Adds a INNER JOIN clause to the query using the Game relation
 *
 * @method     ChildFleetQuery joinWithGame($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Game relation
 *
 * @method     ChildFleetQuery leftJoinWithGame() Adds a LEFT JOIN clause and with to the query using the Game relation
 * @method     ChildFleetQuery rightJoinWithGame() Adds a RIGHT JOIN clause and with to the query using the Game relation
 * @method     ChildFleetQuery innerJoinWithGame() Adds a INNER JOIN clause and with to the query using the Game relation
 *
 * @method     ChildFleetQuery leftJoinShip($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ship relation
 * @method     ChildFleetQuery rightJoinShip($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ship relation
 * @method     ChildFleetQuery innerJoinShip($relationAlias = null) Adds a INNER JOIN clause to the query using the Ship relation
 *
 * @method     ChildFleetQuery joinWithShip($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Ship relation
 *
 * @method     ChildFleetQuery leftJoinWithShip() Adds a LEFT JOIN clause and with to the query using the Ship relation
 * @method     ChildFleetQuery rightJoinWithShip() Adds a RIGHT JOIN clause and with to the query using the Ship relation
 * @method     ChildFleetQuery innerJoinWithShip() Adds a INNER JOIN clause and with to the query using the Ship relation
 *
 * @method     \PropelModels\GameQuery|\PropelModels\ShipQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFleet findOne(ConnectionInterface $con = null) Return the first ChildFleet matching the query
 * @method     ChildFleet findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFleet matching the query, or a new ChildFleet object populated from the query conditions when no match is found
 *
 * @method     ChildFleet findOneById(int $id) Return the first ChildFleet filtered by the id column
 * @method     ChildFleet findOneByIdGame(int $id_game) Return the first ChildFleet filtered by the id_game column
 * @method     ChildFleet findOneBySide(string $side) Return the first ChildFleet filtered by the side column *

 * @method     ChildFleet requirePk($key, ConnectionInterface $con = null) Return the ChildFleet by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFleet requireOne(ConnectionInterface $con = null) Return the first ChildFleet matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFleet requireOneById(int $id) Return the first ChildFleet filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFleet requireOneByIdGame(int $id_game) Return the first ChildFleet filtered by the id_game column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFleet requireOneBySide(string $side) Return the first ChildFleet filtered by the side column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFleet[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFleet objects based on current ModelCriteria
 * @method     ChildFleet[]|ObjectCollection findById(int $id) Return ChildFleet objects filtered by the id column
 * @method     ChildFleet[]|ObjectCollection findByIdGame(int $id_game) Return ChildFleet objects filtered by the id_game column
 * @method     ChildFleet[]|ObjectCollection findBySide(string $side) Return ChildFleet objects filtered by the side column
 * @method     ChildFleet[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FleetQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \PropelModels\Base\FleetQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'battleship', $modelName = '\\PropelModels\\Fleet', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFleetQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFleetQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFleetQuery) {
            return $criteria;
        }
        $query = new ChildFleetQuery();
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
     * @return ChildFleet|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FleetTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FleetTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFleet A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_game, side FROM fleet WHERE id = :p0';
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
            /** @var ChildFleet $obj */
            $obj = new ChildFleet();
            $obj->hydrate($row);
            FleetTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFleet|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFleetQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FleetTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFleetQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FleetTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildFleetQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(FleetTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(FleetTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FleetTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_game column
     *
     * Example usage:
     * <code>
     * $query->filterByIdGame(1234); // WHERE id_game = 1234
     * $query->filterByIdGame(array(12, 34)); // WHERE id_game IN (12, 34)
     * $query->filterByIdGame(array('min' => 12)); // WHERE id_game > 12
     * </code>
     *
     * @see       filterByGame()
     *
     * @param     mixed $idGame The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFleetQuery The current query, for fluid interface
     */
    public function filterByIdGame($idGame = null, $comparison = null)
    {
        if (is_array($idGame)) {
            $useMinMax = false;
            if (isset($idGame['min'])) {
                $this->addUsingAlias(FleetTableMap::COL_ID_GAME, $idGame['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idGame['max'])) {
                $this->addUsingAlias(FleetTableMap::COL_ID_GAME, $idGame['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FleetTableMap::COL_ID_GAME, $idGame, $comparison);
    }

    /**
     * Filter the query on the side column
     *
     * Example usage:
     * <code>
     * $query->filterBySide('fooValue');   // WHERE side = 'fooValue'
     * $query->filterBySide('%fooValue%', Criteria::LIKE); // WHERE side LIKE '%fooValue%'
     * </code>
     *
     * @param     string $side The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFleetQuery The current query, for fluid interface
     */
    public function filterBySide($side = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($side)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FleetTableMap::COL_SIDE, $side, $comparison);
    }

    /**
     * Filter the query by a related \PropelModels\Game object
     *
     * @param \PropelModels\Game|ObjectCollection $game The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFleetQuery The current query, for fluid interface
     */
    public function filterByGame($game, $comparison = null)
    {
        if ($game instanceof \PropelModels\Game) {
            return $this
                ->addUsingAlias(FleetTableMap::COL_ID_GAME, $game->getId(), $comparison);
        } elseif ($game instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FleetTableMap::COL_ID_GAME, $game->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByGame() only accepts arguments of type \PropelModels\Game or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Game relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFleetQuery The current query, for fluid interface
     */
    public function joinGame($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Game');

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
            $this->addJoinObject($join, 'Game');
        }

        return $this;
    }

    /**
     * Use the Game relation Game object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PropelModels\GameQuery A secondary query class using the current class as primary query
     */
    public function useGameQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGame($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Game', '\PropelModels\GameQuery');
    }

    /**
     * Filter the query by a related \PropelModels\Ship object
     *
     * @param \PropelModels\Ship|ObjectCollection $ship the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFleetQuery The current query, for fluid interface
     */
    public function filterByShip($ship, $comparison = null)
    {
        if ($ship instanceof \PropelModels\Ship) {
            return $this
                ->addUsingAlias(FleetTableMap::COL_ID, $ship->getIdFleet(), $comparison);
        } elseif ($ship instanceof ObjectCollection) {
            return $this
                ->useShipQuery()
                ->filterByPrimaryKeys($ship->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByShip() only accepts arguments of type \PropelModels\Ship or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Ship relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFleetQuery The current query, for fluid interface
     */
    public function joinShip($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Ship');

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
            $this->addJoinObject($join, 'Ship');
        }

        return $this;
    }

    /**
     * Use the Ship relation Ship object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PropelModels\ShipQuery A secondary query class using the current class as primary query
     */
    public function useShipQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinShip($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Ship', '\PropelModels\ShipQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFleet $fleet Object to remove from the list of results
     *
     * @return $this|ChildFleetQuery The current query, for fluid interface
     */
    public function prune($fleet = null)
    {
        if ($fleet) {
            $this->addUsingAlias(FleetTableMap::COL_ID, $fleet->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the fleet table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FleetTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FleetTableMap::clearInstancePool();
            FleetTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FleetTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FleetTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FleetTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FleetTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FleetQuery
