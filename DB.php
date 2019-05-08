<?php

class DB {

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "game";
    public $conn;

    function __construct() {
        $this->connect();
    }

    function connect() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            return $this->conn->connect_error;
        }
    }

    function query($sql) {
        $sql1 = "SET NAMES utf8";
        $this->conn->query($sql1);
      
        $result = $this->conn->query($sql);

        if ($this->conn->connect_errno) {
            echo $this->conn->connect_error;
        }
        $rw = [];

        if (is_bool($result)) {
            $this->close();
            return $result;
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rw[] = $row;
            }
            $this->close();
            return $rw;
        } else {
            $this->close();
            return null;
        }
    }

    function getAll($table, $where = null, $orderby = null, $limit = null) {

        //$sql = "SET NAMES utf8";
        //$this->conn->query($sql);
        $sql_where = "";
        $sql_orderby = "";
        $sql = "SELECT * FROM " . $table;

        if ($where != null) {

            foreach ($where as $key => $value) {
                $expr[] = $key . "=" . $value;
            }

            $sql_where = " WHERE 1 AND " . join(' and ', $expr);
            $sql = $sql . $sql_where;
        }

        if ($orderby != null) {
            $sql = $sql . " ORDER BY " . $orderby;
        }

        if ($limit != null) {
            $sql = $sql . " LIMIT " . $limit;
        }

        $result = $this->conn->query($sql);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $rw = [];
        if (!$result) {
            $this->close();
            return $rw;
        }
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rw[] = $row;
            }
            $this->close();
            return $rw;
        } else {
            $this->close();
            return [];
        }
    }

    function getTableCols($table, $params, $where = null, $orderby = null) {
        // $this->connect();
        $columns = join(",", $params);
        $sql = "SELECT " . $columns . " FROM " . $table;

        if ($where != null) {
            $sql = $sql . " WHERE " . $where;
        }

        if ($orderby != null) {
            $sql = $sql . " ORDER BY " . $orderby;
        }
        $rw = [];

        $result = $this->conn->query($sql);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $rw[] = $row;
            }
        } else {
            $rw = null;
        }
        $this->close();
        return $rw;
    }

    function update($table, $params, $where = null, $error = null) {

        $sql = "UPDATE " . $table . " SET ";
        $expr = [];

        foreach ($params as $key => $value) {
            $expr[] = $key . "=" . $value;
        }
        $sql = $sql . join(',', $expr);

        if ($where != null) {
            $sql = $sql . " WHERE " . $where;
        }

        $result = $this->conn->query($sql);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $conn->connect_error . " in " . $error);
        }
        $this->close();
        return $result;
    }

    function delete($table, $where) {

        if ($table != null || $where != null) {
            $wh = "";
            for ($i = 0; $i < count($where); $i++) {
                $k = key($where[$i]);
                $val = $where[$i][$k];
                $wh1 = is_string($val) ? "'" . $val . "'" : $val;
                $wh = $wh . " and " . $k . "=" . $wh1;
            }

            $sql = "DELETE FROM " . $table . " WHERE 1" . $wh;
            $result = $this->conn->query($sql);
            if ($this->conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $this->close();
            return $result;
        }
    }

    function insert($table, $params, $error = null) {
        if ($table == null) {
            die("No table name in" . $error);
        }
        if (is_null($params) || count($params) == 0) {
            die("Table columns not set in " . $error);
        }

        if ($table != null || $params != null) {
            $keys = array_keys($params);
            $values = array_values($params);

            $sql = "INSERT INTO " . $table . "(" . join(",", $keys) . ") VALUES(" . join(",", $values) . ")";

            $result = $this->conn->query($sql);

            if ($this->conn->connect_error) {
                die("Connection failed: " . $conn->connect_error . " in " . $error);
            }

            $last_id = $this->conn->insert_id;
            return $last_id;
        }
    }

    function close() {
        $this->conn->close();
    }

}

?>
