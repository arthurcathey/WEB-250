<?php

class Bird
{
  public ?string $commonName;
  public ?string $latinName;

  public function __construct(array $args = [])
  {
    $this->commonName = $args['commonName'] ?? null;
    $this->latinName  = $args['latinName'] ?? null;
  }

  public function summary(): string
  {
    $commonName = $this->commonName ?? "Unknown Bird";
    $latinName  = $this->latinName ?? "Latin name is undefined";

    return "Common name: {$commonName}<br>" .
      "Latin name: {$latinName}";
  }
}

$bird01 = new Bird([
  'commonName' => 'Acadian Flycatcher',
  'latinName'  => 'Empidonax virescens'
]);

$bird02 = new Bird([
  'commonName' => 'Carolina wren',
  'latinName'  => 'thryothorus ludovicianus'
]);

echo $bird01->summary() . "<br><hr>";
echo $bird02->summary() . "<br>";
