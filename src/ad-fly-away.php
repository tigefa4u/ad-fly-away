<?php

/**
 * A simple class to bypass adf.ly advertisements and go directly to the destination. Ad, fly away!
 */

class adFlyAway {

    public $url = 'http://adf.ly';

    /**
     * Returns the content of the adf.ly page
     * @param  string $id The id of the adf.ly link
     * @return string     The content of the page
     */
    private function getAdfly($id)
    {
        return @file_get_contents('http://adf.ly/'.$id);
    }

    /**
     * Parses the adf.ly page to fetch the destination URL
     * @param  string $id The id of the adf.ly link
     * @return string     The final, valid adf.ly destination
     */
    private function parseURL($id)
    {
        $content = $this->getAdfly($id);

        if(preg_match("/var url = '(.*?)';/i", $content, $match))
        {
            $result = $match[0];
            $result = str_replace("var url = '", '', $result);
            $result = str_replace("';", '', $result);
        }
        else
        {
            $result = '';
        }

        return $result;
    }

    /**
     * Parses and redirects to the final destination
     * @param  string $id The id of the adf.ly link
     */
    public function bypass($id)
    {
        $this->url .= $this->parseURL($id);

        if($this->url === 'http://adf.ly')
        {
            die("Could not parse id {$id}. Are you sure it exists?");
        }

        return $this;
    }

    /**
     * Redirects the client to the destination
     */
    public function redirect()
    {
        header("Location: {$this->url}");
    }
}