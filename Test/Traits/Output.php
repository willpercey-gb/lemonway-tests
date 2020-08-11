<?php

namespace Tests\Traits;

trait Output
{
    public $output;

    /**
     * @param mixed $output
     */
    public function setOutput($output)
    {
        $this->output = $output;
    }

    public function info($input)
    {
        $this->output->writeLn('<info>' . $input . '</info>');
    }

    public function error($input)
    {
        $this->output->writeLn('<error>' . $input . '</error>');
    }

    public function comment($input)
    {
        $this->output->writeLn('<comment>' . $input . '</comment>');
    }

    public function question($input)
    {
        $this->output->writeLn('<question>' . $input . '</question>');
    }
}
