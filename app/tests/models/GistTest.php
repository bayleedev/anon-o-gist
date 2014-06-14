<?php

class GistTest extends TestCase {

  public function testSuccessfullyCreate()
  {
    $gist = Gist::create(array(
      'name' => 'test.php',
      'body' => '<?php echo "hi"; ?>',
    ));
    $this->assertTrue($gist->save());
  }

  public function testCreateNameIsRequired()
  {
    $gist = Gist::create(array(
      'body' => 'hello world',
    ));
    $this->assertFalse($gist->save());
  }

  public function testCreateNameNeedsToBeBetween4and16characters()
  {
    $gist = Gist::create(array(
      'name' => 'hi',
      'body' => 'world',
    ));
    $this->assertFalse($gist->save());
  }

  public function testCreateBodyIsRequired()
  {
    $gist = Gist::create(array(
      'name' => 'test.php',
    ));
    $this->assertFalse($gist->save());
  }

  public function testNewGistSetsFlagsToZero()
  {
    $gist = Gist::create(array(
      'name' => 'test.php',
      'body' => '<?php echo "hi"; ?>',
    ));
    $gist->save();
    $this->assertEquals(0, $gist->flags);
  }

  public function testIsExpiredCreatedToday()
  {
    $gist = Gist::create(array(
      'name' => 'test.php',
      'body' => '<?php echo "hi"; ?>',
    ));
    $this->assertFalse($gist->isExpired());
  }

  public function testIsExpiredCreatedLastMonth()
  {
    $gist = Gist::create(array(
      'name' => 'test.php',
      'body' => '<?php echo "hi"; ?>',
    ));
    $gist->created_at = date('Y-m-d H:i:s', strtotime('-1 month'));
    $this->assertTrue($gist->isExpired());
  }

  // TODO Incomplete
  public function testExcerptOverTwelveWords()
  {
    $gist = Gist::create(array(
      'name' => 'test.php',
      'body' => 'Cat ipsum dolor sit amet, hunt anything that moves or hopped up on goofballs hide when guests come over. Hide when guests come over intrigued by the shower, or stare at ceiling climb leg for stretch and use lap as chair.',
    ));
  }

  // TODO Incomplete
  public function testExcerptUnderTwelveWords()
  {
  }

}