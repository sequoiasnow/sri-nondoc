<?php
/**
 * Define's a class that uses static methods to allow for a global namespace
 * for the use of a database.
 */
class Database {
    // The connection for the database.
    private static $connection;

    /**
     * Opens a new database connection with parameters from config.php
     */
    private static function openConnection() {
        self::$connection = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );

        if ( self::$connection->connect_errno ) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }

        return self::$connection;
    }

    /**
     * Closses the connection to the database... use openConnection() to renew.
     */
    protected static function closeConnection() {
        self::$connection->close();
        self::$conneciton = false;
    }

    /**
     * Returns the connection and opens it if is necessary.
     *
     * @return mysqli.
     */
    protected static function getConnection() {
        if ( ! self::$connection ) {
            return self::openConnection();
        }
        return self::$connection;
     }

    /**
     * Escapes a string of special mysqli parameters.
     *
     * @param string $string
     *
     * @return stirng
     */
    public static function escapeString( $string ) {
        $connection = self::getConnection();
        return $connection->real_escape_string( $string );
    }

    /**
     * Turns an associative array into an array of format col=val.
     *
     * @param array $array
     *
     * @return array
     */
    protected static function makeArrayColVal( $array ) {
        return array_map( function( $k, $v ) {
            return "`$k`='$v'";
        }, array_keys( $where ), array_values( $where ) );
    }

    /**
     * Returns the table name with a prefix.
     *
     * @param string $name
     *
     * @return string
     */
    protected static function getTableName( $name ) {
        return  $name;
    }

    /**
     * Perform a mysqli query.
     *
     * @param string $query
     *
     * @return mysqli::query
     */
    public static function query( $statement ) {
        $connection = self::getConnection();
        return $connection->query( $statement );
    }

    /**
     * Query a table to select where certain columns are certain values.
     *
     * @param array $what
     * @param string $which
     * @param array $where
     *
     * @return array
     */
    public static function select( $what, $which, $where = false ) {
        // Start by preparing the query string...
        $query = 'SELECT ';
        $query .= implode( $what, ', ' ) . ' ';
        $query .= 'FROM '. self::getTableName( $which ) . ' ';

        if ( $where ) {
            // Create the where array.
            $where = self::makeArrayColVal( $where );

            $query .= 'WHERE ' . implode( $where, ', ' );
        }

        // Execute the function.
        $res = self::query( $query );

        // Create the two dimensional array.
        $array = array();
        while( $row = $res->fetch_assoc() ) {
            $array[] = $row;
        }

        // Close the resonse.
        $res->close();

        return $array;
    }

    /**
     * Perform an insert into a table.
     *
     * @param string $table
     * @param array $data
     *
     * @return mysqli::result || false
     */
    public static function insert( $table, $data ) {
        // Create the query string.
        $query = 'INSERT INTO ' . self::getTableName( $table ) . ' ';
        $query .= '(' . implode( array_keys( $data ), ', ' ) . ')' . ' ';
        $query .= 'VALUES (' . implode( array_values( $data ), ', ' ) . ')';

        // Get the connection
        $connection = self::getConnection();

        return $connection->query( $query );
    }

    /**
     * Perform an insert into a table.
     *
     * @param string $table
     * @param array $data
     *
     * @return mysqli::result || false
     */
    public static function update( $table, $data, $where ) {
        // Create the query string.
        $query = 'UPDATAE ' . self::getTableName( $table ) . ' ';
        $query .= 'SET ' . implode( self::makeArrayColVal( $data ), ', ' ) . ' ';
        $query .= 'WHERE ' . implode( self::makeArrayColVal( $where ), ', ' );

        // Get the connection
        $connection = self::getConnection();

        return $connection->query( $query );
    }

    /**
     * Saves a data type based off of its class name.
     *
     * If the object has an id then update else create a new instace of it.
     *
     * @param $object DataType
     *
     * @return DataType || false
     */
    public static function save( &$object ) {
       // Check if the object has an id, if not save the object as a new and get
       // its id. Ensure the id is valid.
       $id = $object->getDataVar( 'id' );

       // Get the table name from the user.
       if ( ! defined( get_class( $object ) . '::TableName' ) ) { return false; }

       $tableName = constant( get_class( $object ) . '::TableName'  );

       if ( $id && count( self::select( array( '*' ), $tableName, array( 'id' => $id ) ) ) ) {
           self::update( 'users', $object->getData(), array( 'id' => $id ) );
           return $object;
       }
       self::insert( 'users', $object->getData() );

       // Change the id.
       $connection = self::getConnection();
       $object->setDataVar( 'id', $connection->insert_id );

       // Return the object in case that is necessary.
       return $object;
    }
}
