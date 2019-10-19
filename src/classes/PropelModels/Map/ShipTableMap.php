<?php

namespace PropelModels\Map;

use PropelModels\Ship;
use PropelModels\ShipQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'ship' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ShipTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'PropelModels.Map.ShipTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'battleship';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'ship';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\PropelModels\\Ship';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'PropelModels.Ship';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id field
     */
    const COL_ID = 'ship.id';

    /**
     * the column name for the id_fleet field
     */
    const COL_ID_FLEET = 'ship.id_fleet';

    /**
     * the column name for the type field
     */
    const COL_TYPE = 'ship.type';

    /**
     * the column name for the length field
     */
    const COL_LENGTH = 'ship.length';

    /**
     * the column name for the startX field
     */
    const COL_STARTX = 'ship.startX';

    /**
     * the column name for the startY field
     */
    const COL_STARTY = 'ship.startY';

    /**
     * the column name for the direction field
     */
    const COL_DIRECTION = 'ship.direction';

    /**
     * the column name for the coordinates field
     */
    const COL_COORDINATES = 'ship.coordinates';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'IdFleet', 'Type', 'Length', 'Startx', 'Starty', 'Direction', 'Coordinates', ),
        self::TYPE_CAMELNAME     => array('id', 'idFleet', 'type', 'length', 'startx', 'starty', 'direction', 'coordinates', ),
        self::TYPE_COLNAME       => array(ShipTableMap::COL_ID, ShipTableMap::COL_ID_FLEET, ShipTableMap::COL_TYPE, ShipTableMap::COL_LENGTH, ShipTableMap::COL_STARTX, ShipTableMap::COL_STARTY, ShipTableMap::COL_DIRECTION, ShipTableMap::COL_COORDINATES, ),
        self::TYPE_FIELDNAME     => array('id', 'id_fleet', 'type', 'length', 'startX', 'startY', 'direction', 'coordinates', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdFleet' => 1, 'Type' => 2, 'Length' => 3, 'Startx' => 4, 'Starty' => 5, 'Direction' => 6, 'Coordinates' => 7, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idFleet' => 1, 'type' => 2, 'length' => 3, 'startx' => 4, 'starty' => 5, 'direction' => 6, 'coordinates' => 7, ),
        self::TYPE_COLNAME       => array(ShipTableMap::COL_ID => 0, ShipTableMap::COL_ID_FLEET => 1, ShipTableMap::COL_TYPE => 2, ShipTableMap::COL_LENGTH => 3, ShipTableMap::COL_STARTX => 4, ShipTableMap::COL_STARTY => 5, ShipTableMap::COL_DIRECTION => 6, ShipTableMap::COL_COORDINATES => 7, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_fleet' => 1, 'type' => 2, 'length' => 3, 'startX' => 4, 'startY' => 5, 'direction' => 6, 'coordinates' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('ship');
        $this->setPhpName('Ship');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\PropelModels\\Ship');
        $this->setPackage('PropelModels');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('id_fleet', 'IdFleet', 'INTEGER', 'fleet', 'id', true, null, null);
        $this->addColumn('type', 'Type', 'VARCHAR', true, 250, '');
        $this->addColumn('length', 'Length', 'INTEGER', true, null, null);
        $this->addColumn('startX', 'Startx', 'INTEGER', true, null, null);
        $this->addColumn('startY', 'Starty', 'INTEGER', true, null, null);
        $this->addColumn('direction', 'Direction', 'VARCHAR', true, 250, '');
        $this->addColumn('coordinates', 'Coordinates', 'VARCHAR', true, 500, '');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Fleet', '\\PropelModels\\Fleet', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_fleet',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', null, false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? ShipTableMap::CLASS_DEFAULT : ShipTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Ship object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ShipTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ShipTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ShipTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ShipTableMap::OM_CLASS;
            /** @var Ship $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ShipTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = ShipTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ShipTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Ship $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ShipTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(ShipTableMap::COL_ID);
            $criteria->addSelectColumn(ShipTableMap::COL_ID_FLEET);
            $criteria->addSelectColumn(ShipTableMap::COL_TYPE);
            $criteria->addSelectColumn(ShipTableMap::COL_LENGTH);
            $criteria->addSelectColumn(ShipTableMap::COL_STARTX);
            $criteria->addSelectColumn(ShipTableMap::COL_STARTY);
            $criteria->addSelectColumn(ShipTableMap::COL_DIRECTION);
            $criteria->addSelectColumn(ShipTableMap::COL_COORDINATES);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_fleet');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.length');
            $criteria->addSelectColumn($alias . '.startX');
            $criteria->addSelectColumn($alias . '.startY');
            $criteria->addSelectColumn($alias . '.direction');
            $criteria->addSelectColumn($alias . '.coordinates');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(ShipTableMap::DATABASE_NAME)->getTable(ShipTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ShipTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ShipTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ShipTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Ship or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Ship object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShipTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \PropelModels\Ship) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ShipTableMap::DATABASE_NAME);
            $criteria->add(ShipTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ShipQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ShipTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ShipTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the ship table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ShipQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Ship or Criteria object.
     *
     * @param mixed               $criteria Criteria or Ship object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShipTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Ship object
        }

        if ($criteria->containsKey(ShipTableMap::COL_ID) && $criteria->keyContainsValue(ShipTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ShipTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ShipQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ShipTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ShipTableMap::buildTableMap();
