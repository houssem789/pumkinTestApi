<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;
use Doctrine\ORM\EntityManagerInterface;


class ImportDataCommand extends Command
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure()
    {
        // The name and description for the command in app/command
        $this->setName('import:csv')
            ->setDescription('Import data from CSV file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Showing when the script is launched
        $now = new \DateTime();
        $output->writeln('<comment>Start : ' . $now->format('d-m-Y G:i:s') . ' ---</comment>');

        // Importing CSV on DB via Doctrine ORM
        $this->importFile($input, $output, 'public/data/exports-des-gares-idf.csv');



        // Showing when the script is over
        $now = new \DateTime();
        $output->writeln('<comment>End : ' . $now->format('d-m-Y G:i:s') . ' ---</comment>');
    }

    protected function importFile(InputInterface $input, OutputInterface $output, $filename)
    {
        // Getting doctrine manager
        $em = $this->em;
        // Turning off doctrine default logs queries for saving memory (for big files)
        $em->getConnection()->getConfiguration()->setSQLLogger(null);
        // Getting php array of data from CSV
        $dataArray = $this->convert($filename);

        // Define the size of record, the frequency for persisting the data and the current index of records
        $size = count($dataArray);
        $batchSize = 1000;
        $i = 1;

        // Starting progress
        $progress = new ProgressBar($output, $size);
        $progress->start();

        // Processing on each row of data
        foreach ($dataArray as $row) {
            $this->setData($row);
            // Each 1000 entries persisted we flush everything
            if (($i % $batchSize) === 0) {
                $em->flush();
                // Detaches all entries from Doctrine for memory save
                $em->clear();
            }
            $i++;
        }

        // Flushing and clear data on queue
        $em->flush();
        $em->clear();

        // Ending the progress bar process
        $now = new \DateTime();
        $progress->advance($size);
        $output->writeln($now->format('d-m-Y G:i:s'));
        $progress->finish();
    }

    public function setData($row)
    {
        $em = $this->em;
    }


    public function convert($filename, $delimiter = ';')
    {
        // Check if the file exist and is readable
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        // Initialize arrays
        $header = NULL;
        $data = array();

        // Parse the csv file
        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {

                // Get the 1st line to set the names for each field
                if (!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }

            // Close the file
            fclose($handle);
        }
        return $data;
    }
}
