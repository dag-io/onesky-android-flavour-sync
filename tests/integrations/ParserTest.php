<?php

use DAG\OneSky\Configuration\Credentials\Parser as CredentialsParser;
use DAG\OneSky\Configuration\Project\Parser as ProjectParser;

class ParserTest extends PHPUnit_Framework_TestCase
{
    public function testProjectWithSingleFileParser()
    {
        $parser = new ProjectParser();
        $project = $parser->parse(__DIR__.'/single-file-scenario/.onesky.strings.yml');

        $this->assertEquals('123', $project->getId());
        $this->assertEquals('en_US', $project->getStringFiles()[0]->getLocale());
        $this->assertEquals(
            'tests/integrations/single-file-scenario/strings.xml',
            $project->getStringFiles()[0]->getPath()
        );
    }

    public function testProjectWithFolderParser()
    {
        $parser = new ProjectParser();
        $project = $parser->parse(__DIR__.'/folder-of-strings-scenario/.onesky.strings.yml');

        $this->assertEquals('123', $project->getId());
        $this->assertEquals('en_US', $project->getStringFiles()[0]->getLocale());
        $this->assertEquals(
            'tests/integrations/folder-of-strings-scenario/strings/strings.xml',
            $project->getStringFiles()[0]->getPath()
        );
    }

    public function testCredentialsParser()
    {
        $parser = new CredentialsParser();
        $credentials = $parser->parse(__DIR__.'/.onesky.secret.yml');

        $this->assertEquals('123', $credentials->getApiKey());
        $this->assertEquals('456', $credentials->getApiSecret());
    }
}
