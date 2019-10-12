<?php

namespace PropelModels\Base;

use \Exception;
use \PDO;
use PropelModels\History as ChildHistory;
use PropelModels\HistoryQuery as ChildHistoryQuery;
use PropelModels\Map\HistoryTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'history' table.
 *
 *
 *
 * @method     ChildHistoryQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildHistoryQuery orderByIdGame($order = Criteria::ASC) Order by the id_game column
 * @method     ChildHistoryQuery orderByPlayer($order = Criteria::ASC) Order by the player column
 * @method     ChildHistoryQuery orderByX($order = Criteria::ASC) Order by the x column
 * @method     ChildHistoryQuery orderByY($order = Criteria::ASC) Order by the y column
 *
 * @method     ChildHistoryQuery groupById() Group by the id column
 * @method     ChildHistoryQuery groupByIdGame() Group by the id_game column
 * @method     ChildHistoryQuery groupByPlayer() Group by the player column
 * @method     ChildHistoryQuery groupByX() Group by the x column
 * @method     ChildHistoryQuery groupByY() Group by the y column
 *
 * @method     ChildHistoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildHistoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildHistoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildHistoryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildHistoryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildHistoryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildHistoryQuery leftJoinGame($relationAlias = null) Adds a LEFT JOIN clause to the query using the Game relation
 * @method     ChildHistoryQuery rightJoinGame($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Game relation
 * @method     ChildHistoryQuery innerJoinGame($relationAlias = null) Adds a INNER JOIN clause to the query using the Game relation
 *
 * @method     ChildHistoryQuery joinWithGame($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Game relation
 *
 * @method     ChildHistoryQuery leftJoinWithGame() Adds a LEFT JOIN clause and with to the query using the Game relation
 * @method     ChildHistoryQuery rightJoinWithGame() Adds a RIGHT JOIN clause and with to the query using the Game relation
 * @method     ChildHistoryQuery innerJoinWithGame() Adds a INNER JOIN clause and with to the query using the Game relation
 *
 * @method     \PropelModels\GameQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildHistory findOne(ConnectionInterface $con = null) Return the first ChildHistory matching the query
 * @method     ChildHistory findOneOrCreate(ConnectionInterface $con = null) Return the first ChildHistory matching the query, or a new ChildHistory object populated from the query conditions when no match is found
 *
 * @method     ChildHistory findOneById(int $id) Return the first ChildHistory filtered by the id column
 * @method     ChildHistory findOneByIdGame(int $id_game) Return the first ChildHistory filtered by the id_game column
 * @method     ChildHistory findOneByPlayer(string $player) Return the first ChildHistory filtered by the player column
 * @method     ChildHistory findOneByX(int $x) Return the first ChildHistory filtered by the x column
 * @method     ChildHistory findOneByY(int $y) Return the first ChildHistory filtered by the y column *

 * @method     ChildHistory requirePk($key, ConnectionInterface $con = null) Return the ChildHistory by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHistory requireOne(ConnectionInterface $con = null) Return the first ChildHistory matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHistory requireOneById(int $id) Return the first ChildHistory filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHistory requireOneByIdGame(int $id_game) Return the first ChildHistory filtered by the id_game column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHistory requireOneByPlayer(string $player) Return the first ChildHistory filtered by the player column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHistory requireOneByX(int $x) Return the first ChildHistory filtered by the x column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHistory requireOneByY(int $y) Return the first ChildHistory filtered by the y column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHistory[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildHistory objects based on current ModelCriteria
 * @method     ChildHistory[]|ObjectCollection findById(int $id) Return ChildHistory objects filtered by the id column
 * @method     ChildHistory[]|ObjectCollection findByIdGame(int $id_game) Return ChildHistory objects filtered by the id_game column
 * @method     ChildHistory[]|ObjectCollection findByPlayer(string $player) Return ChildHistory objects filtered by the player column
 * @method     ChildHistory[]|ObjectCollection findByX(int $x) Return ChildHistory objects filtered by the x column
 * @method     ChildHistory[]|ObjectCollection findByY(int $y) Return ChildHistory objects filtered by the y column
 * @method     ChildHistory[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class HistoryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \PropelModels\Base\HistoryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'battleship', $modelName = '\\PropelModels\\History', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildHistoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildHistoryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildHistoryQuery) {
            return $criteria;
        }
        $query = new ChildHistoryQuery();
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
     * @return ChildHistory|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(HistoryTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = HistoryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildHistory A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_game, player, x, y FROM history WHERE id = :p0';
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
            /** @var ChildHistory $obj */
            $obj = new ChildHistory();
            $obj->hydrate($row);
            HistoryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildHistory|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildHistoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(HistoryTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildHistoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(HistoryTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildHistoryQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(HistoryTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(HistoryTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HistoryTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildHistoryQuery The current query, for fluid interface
     */
    public function filterByIdGame($idGame = null, $comparison = null)
    {
        if (is_array($idGame)) {
            $useMinMax = false;
            if (isset($idGame['min'])) {
                $this->addUsingAlias(HistoryTableMap::COL_ID_GAME, $idGame['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idGame['max'])) {
                $this->addUsingAlias(HistoryTableMap::COL_ID_GAME, $idGame['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HistoryTableMap::COL_ID_GAME, $idGame, $comparison);
    }

    /**
     * Filter the query on the player column
     *
     * Example usage:
     * <code>
     * $query->filterByPlayer('fooValue');   // WHERE player = 'fooValue'
     * $query->filterByPlayer('%fooValue%', Criteria::LIKE); // WHERE player LIKE '%fooValue%'
     * </code>
     *
     * @param     string $player The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHistoryQuery The current query, for fluid interface
     */
    public function filterByPlayer($player = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($player)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HistoryTableMap::COL_PLAYER, $player, $comparison);
    }

    /**
     * Filter the query on the x column
     *
     * Example usage:
     * <code>
     * $query->filterByX(1234); // WHERE x = 1234
     * $query->filterByX(array(12, 34)); // WHERE x IN (12, 34)
     * $query->filterByX(array('min' => 12)); // WHERE x > 12
     * </code>
     *
     * @param     mixed $x The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHistoryQuery The current query, for fluid interface
     */
    public function filterByX($x = null, $comparison = null)
    {
        if (is_array($x)) {
            $useMinMax = false;
            if (isset($x['min'])) {
                $this->addUsingAlias(HistoryTableMap::COL_X, $x['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($x['max'])) {
                $this->addUsingAlias(HistoryTableMap::COL_X, $x['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HistoryTableMap::COL_X, $x, $comparison);
    }

    /**
     * Filter the query on the y column
     *
     * Example usage:
     * <code>
     * $query->filterByY(1234); // WHERE y = 1234
     * $query->filterByY(array(12, 34)); // WHERE y IN (12, 34)
     * $query->filterByY(array('min' => 12)); // WHERE y > 12
     * </code>
     *
     * @param     mixed $y The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHistoryQuery The current query, for fluid interface
     */
    public function filterByY($y = null, $comparison = null)
    {
        if (is_array($y)) {
            $useMinMax = false;
            if (isset($y['min'])) {
                $this->addUsingAlias(HistoryTableMap::COL_Y, $y['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($y['max'])) {
                $this->addUsingAlias(HistoryTableMap::COL_Y, $y['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HistoryTableMap::COL_Y, $y, $comparison);
    }

    /**
     * Filter the query by a related \PropelModels\Game object
     *
     * @param \PropelModels\Game|ObjectCollection $game The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildHistoryQuery The current query, for fluid interface
     */
    public function filterByGame($game, $comparison = null)
    {
        if ($game instanceof \PropelModels\Game) {
            return $this
                ->addUsingAlias(HistoryTableMap::COL_ID_GAME, $game->getId(), $comparison);
        } elseif ($game instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(HistoryTableMap::COL_ID_GAME, $game->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildHistoryQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildHistory $history Object to remove from the list of results
     *
     * @return $this|ChildHistoryQuery The current query, for fluid interface
     */
    public function prune($history = null)
    {
        if ($history) {
            $this->addUsingAlias(HistoryTableMap::COL_ID, $history->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the history table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HistoryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HistoryTableMap::clearInstancePool();
            HistoryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(HistoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(HistoryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            HistoryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            HistoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // HistoryQuery
