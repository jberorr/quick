<?php

use BackupManager\Config\Config;
use BackupManager\Filesystems;
use BackupManager\Databases;
use BackupManager\Compressors;
use BackupManager\Manager;

use BackupManager\Filesystems\Destination;

class Backup{



    public function manager()
    {
        $filesystems = new Filesystems\FilesystemProvider(Config::fromPhpFile('system/helpers/backupfiles.php'));
        $filesystems->add(new Filesystems\Awss3Filesystem);
        $filesystems->add(new Filesystems\GcsFilesystem);
        $filesystems->add(new Filesystems\DropboxFilesystem);
        $filesystems->add(new Filesystems\FtpFilesystem);
        $filesystems->add(new Filesystems\LocalFilesystem);
        $filesystems->add(new Filesystems\RackspaceFilesystem);
        $filesystems->add(new Filesystems\SftpFilesystem);
        $databases = new Databases\DatabaseProvider(Config::fromPhpFile('system/helpers/backupdb.php'));
        $databases->add(new Databases\MysqlDatabase);
        $databases->add(new Databases\PostgresqlDatabase);
        $compressors = new Compressors\CompressorProvider;
        $compressors->add(new Compressors\GzipCompressor);
        $compressors->add(new Compressors\NullCompressor);
// build manager
        return new Manager($filesystems, $databases, $compressors);
    }

    public /**
     * MYSQL EXPORT TO GZIP
     * exporting database to sql gzip compression data.
     * if directory writable will be make directory inside of directory if not exist, else wil be die
     *
     * @param string directory , as the directory to put file
     * @param $outname as file name just the name !, if file exist will be overide as numeric next ++ as name_1.sql.gz , name_2.sql.gz next ++
     *
     * @param string $dbhost database host
     * @param string $dbuser database user
     * @param string $dbpass database password
     * @param string $dbname database name
     *
     */
    function backupDatabaseMySqli( $directory, $outname , $action='store' ) {

        // Check mysqli extension installed
        if (!is_function_enabled('mysqli_connect')) {
            die('MySQLi extension is required for backup functionality. Please ensure MySQLi is enabled in your PHP installation.');
        }

        try {
            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            
            if ($mysqli->connect_error) {
                error_log('Database connection error: ' . $mysqli->connect_error);
                return false;
            }
            
            // Set charset to UTF-8
            $mysqli->set_charset('utf8mb4');
        } catch (Exception $e) {
            error_log('Backup initialization error: ' . $e->getMessage());
            return false;
        }

        $dir = $directory;
        $result = '<p>Could not create backup directory on: ' . htmlspecialchars($dir) . '. Please ensure the directory has proper permissions (755 or 777).</p>';
        $res = true;
        
        if (!is_dir($dir)) {
            if (!@mkdir($dir, 0755, true)) {
                $res = false;
            }
        }

        $n = 1;
        if ($res) {

            $name = $outname;
            # Counts and handles file naming
            if (file_exists($dir . '/' . $name . '.sql.gz')) {

                for ($i = 1; $i < 1000; $i++) {
                    $check_file = $dir . '/' . $name . '_' . $i . '.sql.gz';
                    if (!file_exists($check_file)) {
                        $name = $name . '_' . $i;
                        break;
                    }
                }
            }

            $fullname = $dir . '/' . $name . '.sql.gz';

            // Query results safely
            $sql = "SHOW TABLES";
            $show = $mysqli->query($sql);
            
            if (!$show) {
                error_log('Database query error: ' . $mysqli->error);
                return false;
            }
            
            $tables = [];
            while ($r = $show->fetch_array()) {
                $tables[] = $r[0];
            }

            if (!empty($tables)) {

                // Cycle through tables
                $return = '';
                foreach ($tables as $table) {
                    $table = $mysqli->real_escape_string($table);
                    $result = $mysqli->query('SELECT * FROM `' . $table . '`');
                    
                    if (!$result) {
                        error_log('Failed to query table ' . $table . ': ' . $mysqli->error);
                        continue;
                    }
                    
                    $num_fields = $result->field_count;
                    $row2 = $mysqli->query('SHOW CREATE TABLE `' . $table . '`');

                    if ($row2) {
                        $row2 = $row2->fetch_row();
                        $return .=
                            "\n
-- ---------------------------------------------------------
--
-- Table structure for table : `" . addslashes($table) . "`
--
-- ---------------------------------------------------------

" . $row2[1] . ";\n";

                        for ($i = 0; $i < $num_fields; $i++)
                        {
                            $n = 1 ;
                            while( $row = $result->fetch_row() )
                            {


                                if( $n++ == 1 ) { # set the first statements
                                    $return .=
                                        "
--
-- Dumping data for table `{$table}`
--

";
                                    /**
                                     * Get structural of fields each tables
                                     */
                                    $array_field = array(); #reset ! important to resetting when loop
                                    while( $field = $result->fetch_field() ) # get field
                                    {
                                        $array_field[] = '`'.$field->name.'`';

                                    }
                                    $array_f[$table] = $array_field;
                                    // $array_f = $array_f;
                                    # endwhile
                                    $array_field = implode(', ', $array_f[$table]); #implode arrays

                                    $return .= "INSERT INTO `{$table}` ({$array_field}) VALUES\n(";
                                } else {
                                    $return .= '(';
                                }
                                for($j=0; $j<$num_fields; $j++)
                                {

                                    $row[$j] = str_replace('\'','\'\'', preg_replace("/\n/","\\n", $row[$j] ) );
                                    if ( isset( $row[$j] ) ) { $return .= is_numeric( $row[$j] ) ? $row[$j] : '\''.$row[$j].'\'' ; } else { $return.= '\'\''; }
                                    if ($j<($num_fields-1)) { $return.= ', '; }
                                }
                                $return.= "),\n";
                            }
                            # check matching
                            @preg_match("/\),\n/", $return, $match, false, -3); # check match
                            if( isset( $match[0] ) )
                            {
                                $return = substr_replace( $return, ";\n", -2);
                            }

                        }

                        $return .= "\n";

                    }

                    $return =
                        "-- ---------------------------------------------------------
--
-- SIMPLE SQL Dump
-- 
--
-- Host Connection Info: ".$mysqli->host_info."
-- Generation Time: ".date('F d, Y \a\t H:i A ( e )')."
-- PHP Version: ".PHP_VERSION."
--
-- ---------------------------------------------------------\n\n

SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";
SET time_zone = \"+00:00\";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
".$return."
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";

# end values result

                    @ini_set('zlib.output_compression','Off');
                    $gzipoutput = gzencode( $return, 9);

                    if($action == 'store'){
                        if(  @ file_put_contents( $fullname, $gzipoutput  ) ) { # 9 as compression levels

                            $result = $name.'.sql.gz'; # show the name

                        } else { # if could not put file , automaticly you will get the file as downloadable

                            $result = false;
                            // various headers, those with # are mandatory


                        }
                    }
                    else{
                        $result = false;
                        // various headers, those with # are mandatory
                        header('Content-Type: application/x-gzip'); // change it to mimetype
                        header("Content-Description: File Transfer");
                        header('Content-Encoding: gzip'); #
                        header('Content-Length: '.strlen( $gzipoutput ) ); #
                        header('Content-Disposition: attachment; filename="'.$name.'.sql.gz'.'"');
                        header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
                        header('Connection: Keep-Alive');
                        header("Content-Transfer-Encoding: binary");
                        header('Expires: 0');
                        header('Pragma: no-cache');

                        echo $gzipoutput;
                        exit;
                    }



                } else {

                  //  $result = 'Error when executing database query to export - '.$mysqli->error;

                    $result = false;

                }
            }

        } else {
           // $result = 'Wrong mysqli input';
            $result = false;
        }

        if( $mysqli && ! $mysqli->error ) {
            @$mysqli->close();
        }

        return $result;

    }

    public function backupDB($file_path = '')
    {
        $manager = $this->manager();

        $file_name = time();

        if($file_path == '')
        {
            $file_path = 'storage/backups/db/'.$file_name.'.sql';
        }
        try {
            $manager
                ->makeBackup()
                ->run('development', [
                    new Destination('local', $file_path)
                ], 'gzip');

            return [
                'success' => true,
                'message' => 'Backup Successful',
                'file_path' => $file_path
            ];

        } catch (Exception $e){

            return [
                'success' => false,
                'message' => $e->getMessage(),
                'file_path' => $file_path
            ];




        }
    }

}