<?hh // strict 
/*
 *  Copyright (c) 2017-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the MIT license found in the
 *  LICENSE file in the root directory of this source tree.
 *
 */

namespace Facebook\HHAST\Linters;

use type Facebook\HHAST\{
  AnonymousFunction,
  AwaitableCreationExpression,
  AwaitToken,
  CompoundStatement,
  DotDotDotToken,
  EditableList,
  EditableNode,
  EndOfLine,
  IControlFlowStatement,
  ILoopStatement,
  LambdaExpression,
  LeftBraceToken,
  SingleLineComment,
  PrefixUnaryExpression,
  RightBraceToken,
  WhiteSpace,
  __Private\PerfCounter,
  NamespaceDeclaration,
  NamespaceBody,
  NamespaceEmptyBody,
  Script,
  MarkupSection,
  NamespaceUseDeclaration,
  ExpressionStatement,
  FunctionCallExpression,
  Missing,
  EndOfFile,
  AliasDeclaration,
  TypeToken,
};
use function Facebook\HHAST\{Missing, find_position, find_offset};
use namespace Facebook\TypeAssert;
use namespace HH\Lib\{C, Vec};

final class HackToPHPLinter extends ASTLinter<EditableNode> {
  <<__Override>>
  protected static function getTargetType(): classname<Script> {
    return Script::class;
  }

  <<__Override>>
  public function getLintErrorForNode(
    EditableNode $node,
    vec<EditableNode> $parents,
  ): ?ASTLintError<EditableNode> {
    // \var_dump($parents);
    exit($this->transpile($node, $parents, "%s"));
    // if ($node instanceof Script) {
    //   \var_dump("we are a Script!");
    //   $dcls = $node
    //     ->getDeclarations()
    //     ->getChildren();
    // }
    // if ($node instanceof NamespaceDeclaration) {
    //   \var_dump("we are a NamespaceDeclaration!");

    // }


    return null;
  }

  private function transpile(
    EditableNode $node,
    vec<EditableNode> $parents,
    string $php,
  ): string {
    if ($node instanceof Script) {
      $next_nodes = $node
        ->getDeclarations()
        ->getChildren();
      $parents[] = $node;
      foreach ($next_nodes as $key => $next_node) {
        $php = $this->transpile($next_node, $parents, $php);
      }
      return $php;
    }

    if ($node instanceof MarkupSection) { //abstraction
      $php = $this->sprinft($php, "<?php\n%s");
      return $php;
    }
    if ($node instanceof NamespaceDeclaration) {
      $code = $node
        ->getName()
        ->getCode();
      $php = $this->sprinft($php, "namespace $code%s");

      $parents[] = $node;
      $php = $this->transpile($node->getBody(), $parents, $php);

      return $php;
    }
    if ($node instanceof NamespaceBody) {
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }
    if ($node instanceof NamespaceEmptyBody) {
      $php = $this->sprinft($php, ";\n%s");

      return $php;
    }
    if ($node instanceof NamespaceUseDeclaration) { //abstraction
      $ns_cmd = $node
        ->getCode();
      $php = $this->sprinft($php, "$ns_cmd\n%s");
      return $php;
    }

    if ($node instanceof ExpressionStatement) {
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }
    if ($node instanceof FunctionCallExpression) {
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }
    if ($node instanceof Missing) {
      return $php;
    }
    if ($node instanceof AliasDeclaration) {
      return $php;
    }

    if ($node instanceof EndOfFile) {
      $php = $this->sprinft($php, "");
      return $php;
    }


    //HERE BEGINS VERY GENERAL STUFF

    if ($node instanceof EditableList) { //abstraction      
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }

    // if ($node instanceof TypeToken) {
    //   return $php;
    // }

    if ($node->isToken()) { //abstraction    
      $token = $node->getCode();
      $php = $this->sprinft($php, "$token%s");
      return $php;
    }

    throw new \Error(
      "Unknown node (".
      $node->getSyntaxKind().
      "): ".
      $node->getCode().
      " \nCurrent PHP: \n$php",
    );
  }

  // <<__Override>>
  // public function getLintErrors(): Traversable<LintError> {
  //   return Vector {};
  // }

  private static function isAsyncBoundary(Script $node): bool {
    return $node instanceof AnonymousFunction ||
      $node instanceof AwaitableCreationExpression ||
      $node instanceof LambdaExpression;
  }

  private function interate_children(
    EditableNode $node,
    vec<EditableNode> $parents,
    string $php,
  ): string {
    $next_nodes = $node
      ->getChildren();
    $parents[] = $node;
    foreach ($next_nodes as $next_node) {
      $php = $this->transpile($next_node, $parents, $php);
    }
    return $php;
  }

  private function sprinft(string $format, string $arg): string {
    //UNSAFE
    return \sprintf($format, $arg);
  }

  // <<__Override>>
  // public function getPrettyTextForNode(
  //   EditableNode $blame,
  //   ?EditableNode $loops,
  // ): string {
  //   invariant($loops instanceof EditableList, 'Expected a loop context');
  //   $loops = $loops->toVec()
  //     |> Vec\map(
  //       $$,
  //       $item ==> TypeAssert\instance_of(ILoopStatement::class, $item),
  //     );

  //   $lines = \file_get_contents($this->getFile()) |> \explode("\n", $$);

  //   list($blame_line, $_col) = find_position($this->getAST(), $blame);

  //   if (C\count($loops) === 1) {
  //     list($line, $_col) = find_position($this->getAST(), C\onlyx($loops));
  //     if ($line === $blame_line) {
  //       return $lines[$line - 1];
  //     }
  //   }

  //   $output = vec[];
  //   foreach (Vec\reverse($loops) as $loop) {
  //     list($line, $_col) = find_position($this->getAST(), $loop);
  //     $output[] = 'Line '.$line.': '.$lines[$line - 1];
  //   }
  //   $output[] = 'Line '.$blame_line.': '.$lines[$blame_line - 1];

  //   return \implode("\n", $output);
  // }
}
