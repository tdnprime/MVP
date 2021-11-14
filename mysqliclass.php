<?php


// SOURCE: https://gist.github.com/mloberg/1181537/9ee5e7baf0528a604348f1d1bed721ef6d79d1fe

class Database {

  static private $link = null;
  private static $instance = null;

  static private $info = array(
    'last_query' => null,
    'num_rows' => null,
    'insert_id' => null
  );

  static private $connection_info = array();
  static private $where;
  static private $limit;
  static private $order;

  private function __construct() {
    $config = parse_ini_file( "../config/app.ini", true );
    $host = $config[ "database" ][ "host" ];
    $user = $config[ "database" ][ "username" ];
    $pass = $config[ "database" ][ "pass" ];
    $db = $config[ "database" ][ "database" ];
    self::$connection_info = array( 'host' => $host, 'user' => $user, 'pass' => $pass, 'db' => $db );
  }
  public static function getInstance() {
    if ( self::$instance == null ) {
      self::$instance = new Database();
    }
    return self::$instance;
  }

  function __destruct() {
    // if(is_resource(self::$link)) mysqli_close(self::$link);
  }

  /**
   * Setter method
   */

  private function set( $field, $value ) {
    self::$info[ $field ] = $value;
  }

  /**
   * Getter methods
   */

  public function last_query() {
    return self::$info[ 'last_query' ];
  }

  public function num_rows() {
    return self::$info[ 'num_rows' ];
  }

  public function insert_id() {
    return self::$info[ 'insert_id' ];
  }

  /**
   * Create or return a connection to the mysqli server.
   */

  static private function connection() {

   
    if ( !is_resource( self::$link ) || empty( self::$link ) ) {
      if ( ( $link = mysqli_connect( self::$connection_info[ 'host' ], self::$connection_info[ 'user' ], self::$connection_info[ 'pass' ] ) ) && mysqli_select_db( $link, self::$connection_info[ 'db' ] ) ) {
        self::$link = $link;
        mysqli_set_charset( $link, 'utf8' );
      } else {
        throw new Exception( 'Could not connect to MySQL database.' );
      }
    }
    return self::$link;
  }

  /**
   * mysqli Where methods
   */

  static private function __where( $info, $type = 'AND' ) {
    $link = self::connection();
    $where = self::$where;
    foreach ( $info as $row => $value ) {
      if ( empty( $where ) ) {
        $where = sprintf( "WHERE `%s`='%s'", $row, mysqli_real_escape_string( $link, $value ) );
      } else {
        $where .= sprintf( " %s `%s`='%s'", $type, $row, mysqli_real_escape_string( $link, $value ) );
      }
    }
    self::$where = $where;
  }

  public function where( $field, $equal = null ) {
    //if(is_array($field)){
    //self::__where($field);
    //}else{
    self::__where( array( $field => $equal ) );
    //}
    return $this;
  }

  public function and_where( $field, $equal = null ) {
    return $this->where( $field, $equal );
  }

  public function or_where( $field, $equal = null ) {
    if ( is_array( $field ) ) {
      self::__where( $field, 'OR' );
    } else {
      self::__where( array( $field => $equal ), 'OR' );
    }
    return $this;
  }

  /**
   * mysqli limit method
   */

  public function limit( $limit ) {
    self::$limit = 'LIMIT ' . $limit;
    return $this;
  }

  /**
   * mysqli Order By method
   */

  public function order_by( $by, $order_type = 'DESC' ) {
    $order = self::$order;
    if ( is_array( $by ) ) {
      foreach ( $by as $field => $type ) {
        if ( is_int( $field ) && !preg_match( '/(DESC|desc|ASC|asc)/', $type ) ) {
          $field = $type;
          $type = $order_type;
        }
        if ( empty( $order ) ) {
          $order = sprintf( "ORDER BY `%s` %s", $field, $type );
        } else {
          $order .= sprintf( ", `%s` %s", $field, $type );
        }
      }
    } else {
      if ( empty( $order ) ) {
        $order = sprintf( "ORDER BY `%s` %s", $by, $order_type );
      } else {
        $order .= sprintf( ", `%s` %s", $by, $order_type );
      }
    }
    self::$order = $order;
    return $this;
  }

  /**
   * mysqli query helper
   */

  static private function extra() {
    $extra = '';
    if ( !empty( self::$where ) )$extra .= ' ' . self::$where;
    if ( !empty( self::$order ) )$extra .= ' ' . self::$order;
    if ( !empty( self::$limit ) )$extra .= ' ' . self::$limit;
    // cleanup
    self::$where = null;
    self::$order = null;
    self::$limit = null;
    echo $extra;
  }

  /**
   * mysqli Query methods
   */

  public function is_table( $qry ) {
    $link = $this->connection();
    $result = $link->query( $qry );
    if ( $result ) {

      return mysqli_num_rows( $result );

    }

  }

  public static function get( $sql ) {
    $arr = [];
    $link = self::connection();
    $result = $link->query( $sql );
    if ( $result ) {
      $num = mysqli_num_rows( $result );
      for ( $i = 0; $i < $num; $i++ ) {
        array_push( $arr, $rows = mysqli_fetch_assoc( $result ) );
      }
    }

    return $arr;
  }

  public function insert( $table, $data ) {

    $link = $this->connection();
    $fields = '';
    $values = '';
    foreach ( $data as $col => $value ) {

      $fields .= sprintf( "`%s`,", $col );
      $values .= sprintf( "'%s',", $value );
      // $values .= sprintf("'%s',", mysqli_real_escape_string($value));
    }
    $fields = substr( $fields, 0, -1 );
    $values = substr( $values, 0, -1 );

    $sql = sprintf( "INSERT INTO %s (%s) VALUES (%s)", $table, $fields, $values );
    self::set( 'last_query', $sql );
    $result = $link->query( $sql );
    if ( !$result ) {
      throw new Exception( 'Error executing mysqli query: ' . $sql . '. error ' . mysqli_errno() . ': ' . mysqli_error() );
    } else {
      //self::set('insert_id', mysqli_insert_id());
      return true;
    }
  }

  public function update( $table, $info, $clause = null ) {

    $link = $this->connection();
    $update = '';
    foreach ( $info as $col => $value ) {
      $update .= sprintf( "`%s`='%s', ", $col, $value ); // ESCAPE
    }
    $update = substr( $update, 0, -2 );
   $sql = sprintf( "UPDATE %s SET %s%s", $table, $update, $clause );
    //	self::set('last_query', $sql);
    $r = $link->query( $sql );
    if ( !$r ) {
      throw new Exception( 'Error executing query: ' . $sql . '. mysqli error '  . ': ' . $link->error );
    } else {
      return true;
    }

  }

  public function delete( $table, $condition ) {
   /* if ( empty( self::$where ) ) {
      throw new Exception( "Where is not set. Can't delete whole table." );
    } else {*/
      $link = $this->connection();
      $sql = sprintf( "DELETE FROM %s%s", $table, $condition);
      self::set( 'last_query', $sql );
      if ( !$link->query( $sql ) ) {
        throw new Exception( 'Error executing mysqli query: ' . $sql . '. mysqli error ' . mysqli_errno() . ': ' . mysqli_error() );
      } else {
        return true;
      //}
    }
  }

}

?>
