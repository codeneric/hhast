<?hh // strict
/*
 *  Copyright (c) 2017-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the MIT license found in the
 *  LICENSE file in the root directory of this source tree.
 *
 */


namespace Facebook\HHAST;

use function Facebook\FBExpect\expect;
use namespace HH\Lib\{C, Str, Vec};

final class HackToPHPTest extends TestCase {

  private function rglob(string $pattern, int $flags = 0): array<string> {
    $files = \glob($pattern, $flags);
    foreach (
      \glob(\dirname($pattern).'/*', \GLOB_ONLYDIR | \GLOB_NOSORT) as $dir
    ) {
      $files = \array_merge(
        $files,
        $this->rglob($dir.'/'.\basename($pattern), $flags),
      );
    }
    return $files;
  }
  public function testPHPOnlyFeature(): void {
    echo "glob files...";
    $files = $this->rglob("example-files/*.php");
    $i = 0;
    echo \count($files)." hack files to compile...";
    foreach ($files as $filename) {
      $res = \exec("./bin/hhast-lint $filename | php -l");
      expect($res)->toEqual(
        "No syntax errors detected in -",
        "Syntax error in file $filename:\n$res",
      );
      // if ($i >= 10){
      //   return;}
      //   $i++; 
    }


  }
}
