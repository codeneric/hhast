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
  //syntax:
  AliasDeclaration,
  AlternateElseClause,
  AlternateElseifClause,
  AlternateIfStatement,
  AlternateLoopStatement,
  AlternateSwitchStatement,
  AnonymousClass,
  AnonymousFunction,
  AnonymousFunctionUseClause,
  ArrayCreationExpression,
  ArrayIntrinsicExpression,
  AsExpression,
  Attribute,
  AttributeSpecification,
  AwaitableCreationExpression,
  BinaryExpression,
  BracedExpression,
  BreakStatement,
  CaseLabel,
  CastExpression,
  CatchClause,
  ClassishBody,
  ClassishDeclaration,
  ClassnameTypeSpecifier,
  ClosureParameterTypeSpecifier,
  ClosureTypeSpecifier,
  CollectionLiteralExpression,
  CompoundStatement,
  ConditionalExpression,
  ConstantDeclarator,
  ConstDeclaration,
  ConstructorCall,
  ContinueStatement,
  DarrayIntrinsicExpression,
  DarrayTypeSpecifier,
  DeclareBlockStatement,
  DeclareDirectiveStatement,
  DecoratedExpression,
  DefaultLabel,
  DefineExpression,
  DictionaryIntrinsicExpression,
  DictionaryTypeSpecifier,
  DoStatement,
  EchoStatement,
  ElementInitializer,
  ElseClause,
  ElseifClause,
  EmbeddedBracedExpression,
  EmbeddedMemberSelectionExpression,
  EmbeddedSubscriptExpression,
  EmptyExpression,
  EndOfFile,
  EnumDeclaration,
  Enumerator,
  ErrorSyntax,
  EvalExpression,
  ExpressionStatement,
  FieldInitializer,
  FieldSpecifier,
  FinallyClause,
  ForeachStatement,
  ForStatement,
  FunctionCallExpression,
  FunctionCallWithTypeArgumentsExpression,
  FunctionDeclarationHeader,
  FunctionDeclaration,
  FunctionStaticStatement,
  GenericTypeSpecifier,
  GlobalStatement,
  GotoLabel,
  GotoStatement,
  HaltCompilerExpression,
  IfStatement,
  InclusionDirective,
  InclusionExpression,
  InstanceofExpression,
  IsExpression,
  IssetExpression,
  KeysetIntrinsicExpression,
  KeysetTypeSpecifier,
  LambdaExpression,
  LambdaSignature,
  ListExpression,
  ListItem,
  LiteralExpression,
  MapArrayTypeSpecifier,
  MarkupSection,
  MarkupSuffix,
  MemberSelectionExpression,
  MethodishDeclaration,
  NamespaceBody,
  NamespaceDeclaration,
  NamespaceEmptyBody,
  NamespaceGroupUseDeclaration,
  NamespaceUseClause,
  NamespaceUseDeclaration,
  NullableAsExpression,
  NullableTypeSpecifier,
  ObjectCreationExpression,
  ParameterDeclaration,
  ParenthesizedExpression,
  Php7AnonymousFunction,
  PipeVariableExpression,
  PostfixUnaryExpression,
  PrefixUnaryExpression,
  PropertyDeclaration,
  PropertyDeclarator,
  QualifiedName,
  RequireClause,
  ReturnStatement,
  SafeMemberSelectionExpression,
  ScopeResolutionExpression,
  Script,
  ShapeExpression,
  ShapeTypeSpecifier,
  SimpleInitializer,
  SimpleTypeSpecifier,
  SoftTypeSpecifier,
  StaticDeclarator,
  SubscriptExpression,
  SwitchFallthrough,
  SwitchSection,
  SwitchStatement,
  ThrowStatement,
  TraitUseAliasItem,
  TraitUseConflictResolution,
  TraitUse,
  TraitUsePrecedenceItem,
  TryStatement,
  TupleExpression,
  TupleTypeExplicitSpecifier,
  TupleTypeSpecifier,
  TypeArguments,
  TypeConstant,
  TypeConstDeclaration,
  TypeConstraint,
  TypeParameter,
  TypeParameters,
  UnsetStatement,
  UsingStatementBlockScoped,
  UsingStatementFunctionScoped,
  VariableExpression,
  VariadicParameter,
  VarrayIntrinsicExpression,
  VarrayTypeSpecifier,
  VectorArrayTypeSpecifier,
  VectorIntrinsicExpression,
  VectorTypeSpecifier,
  WhereClause,
  WhereConstraint,
  WhileStatement,
  XHPCategoryDeclaration,
  XHPChildrenDeclaration,
  XHPChildrenParenthesizedList,
  XHPClassAttributeDeclaration,
  XHPClassAttribute,
  XHPClose,
  XHPEnumType,
  XHPExpression,
  XHPOpen,
  XHPRequired,
  XHPSimpleAttribute,
  XHPSimpleClassAttribute,
  XHPSpreadAttribute,
  YieldExpression,
  YieldFromExpression,

  //token:
  AbstractToken,
  AmpersandAmpersandToken,
  AmpersandEqualToken,
  AmpersandToken,
  AndToken,
  ArraykeyToken,
  ArrayToken,
  AsToken,
  AsyncToken,
  AtToken,
  AttributeToken,
  AwaitToken,
  BackslashToken,
  BarBarToken,
  BarEqualToken,
  BarGreaterThanToken,
  BarToken,
  BinaryLiteralToken,
  BooleanLiteralToken,
  BoolToken,
  BreakToken,
  CaratEqualToken,
  CaratToken,
  CaseToken,
  CatchToken,
  CategoryToken,
  ChildrenToken,
  ClassnameToken,
  ClassToken,
  CloneToken,
  ColonColonToken,
  ColonToken,
  CommaToken,
  ConstructToken,
  ConstToken,
  ContinueToken,
  CoroutineToken,
  DarrayToken,
  DecimalLiteralToken,
  DeclareToken,
  DefaultToken,
  DefineToken,
  DestructToken,
  DictToken,
  DollarDollarToken,
  DollarToken,
  DotDotDotToken,
  DotEqualToken,
  DoToken,
  DotToken,
  DoubleQuotedStringLiteralHeadToken,
  DoubleQuotedStringLiteralTailToken,
  DoubleQuotedStringLiteralToken,
  DoubleToken,
  EchoToken,
  ElseifToken,
  ElseToken,
  EmptyToken,
  EnddeclareToken,
  EndforeachToken,
  EndforToken,
  EndifToken,
  EndOfFileToken,
  EndswitchToken,
  EndwhileToken,
  EnumToken,
  EqualEqualEqualToken,
  EqualEqualGreaterThanToken,
  EqualEqualToken,
  EqualGreaterThanToken,
  EqualToken,
  ErrorTokenToken,
  EvalToken,
  ExclamationEqualEqualToken,
  ExclamationEqualToken,
  ExclamationToken,
  ExecutionStringLiteralHeadToken,
  ExecutionStringLiteralTailToken,
  ExecutionStringLiteralToken,
  ExtendsToken,
  FallthroughToken,
  FinallyToken,
  FinalToken,
  FloatingLiteralToken,
  FloatToken,
  ForeachToken,
  ForToken,
  FromToken,
  FunctionToken,
  GlobalToken,
  GotoToken,
  GreaterThanEqualToken,
  GreaterThanGreaterThanEqualToken,
  GreaterThanGreaterThanToken,
  GreaterThanToken,
  HaltCompilerToken,
  HeredocStringLiteralHeadToken,
  HeredocStringLiteralTailToken,
  HeredocStringLiteralToken,
  HexadecimalLiteralToken,
  IfToken,
  ImplementsToken,
  Include_onceToken,
  IncludeToken,
  InoutToken,
  InstanceofToken,
  InsteadofToken,
  InterfaceToken,
  IntToken,
  IssetToken,
  IsToken,
  KeysetToken,
  LeftBraceToken,
  LeftBracketToken,
  LeftParenToken,
  LessThanEqualGreaterThanToken,
  LessThanEqualToken,
  LessThanGreaterThanToken,
  LessThanLessThanEqualToken,
  LessThanLessThanToken,
  LessThanQuestionToken,
  LessThanSlashToken,
  LessThanToken,
  ListToken,
  MarkupToken,
  MinusEqualToken,
  MinusGreaterThanToken,
  MinusMinusToken,
  MinusToken,
  MixedToken,
  NamespaceToken,
  NameToken,
  NewToken,
  NewtypeToken,
  NoreturnToken,
  NowdocStringLiteralToken,
  NullLiteralToken,
  NumToken,
  ObjectToken,
  OctalLiteralToken,
  OrToken,
  ParentToken,
  PercentEqualToken,
  PercentToken,
  PlusEqualToken,
  PlusPlusToken,
  PlusToken,
  PrintToken,
  PrivateToken,
  ProtectedToken,
  PublicToken,
  QuestionAsToken,
  QuestionColonToken,
  QuestionGreaterThanToken,
  QuestionMinusGreaterThanToken,
  QuestionQuestionToken,
  QuestionToken,
  RequiredToken,
  Require_onceToken,
  RequireToken,
  ResourceToken,
  ReturnToken,
  RightBraceToken,
  RightBracketToken,
  RightParenToken,
  SelfToken,
  SemicolonToken,
  ShapeToken,
  SingleQuotedStringLiteralToken,
  SlashEqualToken,
  SlashGreaterThanToken,
  SlashToken,
  StarEqualToken,
  StarStarEqualToken,
  StarStarToken,
  StarToken,
  StaticToken,
  StringLiteralBodyToken,
  StringToken,
  SuperToken,
  SuspendToken,
  SwitchToken,
  ThisToken,
  ThrowToken,
  TildeToken,
  TraitToken,
  TryToken,
  TupleToken,
  TypeToken,
  UnsetToken,
  UseToken,
  UsingToken,
  VariableToken,
  VarrayToken,
  VarToken,
  VecToken,
  VoidToken,
  WhereToken,
  WhileToken,
  XHPBodyToken,
  XHPCategoryNameToken,
  XHPClassNameToken,
  XHPCommentToken,
  XHPElementNameToken,
  XHPStringLiteralToken,
  XorToken,
  YieldToken,

  //freestyle: 
  EditableNode,
  Missing,
  EditableList,

};
use function Facebook\HHAST\{Missing, find_position, find_offset};
use namespace Facebook\TypeAssert;
use namespace HH\Lib\{C, Vec};

final class HackToPHPLinter extends ASTLinter<EditableNode> {

  private string $placeholder =
    "kcnvjrhthkndfnkdfknknsdnks"; //make this smarter
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
    exit($this->transpile($node, $parents, $this->placeholder));
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
    $P = $this->placeholder;
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
      $php = $this->sprinft($php, "<?php\n$P");
      return $php;
    }
    if ($node instanceof NamespaceDeclaration) {
      $code = $node
        ->getName()
        ->getCode();
      $php = $this->sprinft($php, "namespace $code$P");

      $parents[] = $node;
      $php = $this->transpile($node->getBody(), $parents, $php);

      return $php;
    }
    if ($node instanceof NamespaceBody) {
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }
    if ($node instanceof NamespaceEmptyBody) {
      $php = $this->sprinft($php, ";\n$P");

      return $php;
    }
    if ($node instanceof NamespaceUseDeclaration) { //abstraction
      $ns_cmd = $node->getClauses()->getCode();
      $php = $this->sprinft($php, "use \\$ns_cmd;\n$P");
      return $php;
    }

    if ($node instanceof ExpressionStatement) {
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }
    if ($node instanceof FunctionCallExpression) {
      $args = $node->getArgumentList();
      if (!\is_null($args)) {
        $last_token = $args->getLastToken();
        if ($last_token instanceof CommaToken) {
          $node = $node->removeWhere(($n, $v) ==> $last_token === $n);
        }
      }
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }
    if ($node instanceof Missing) {
      return $php;
    }

    if ($node instanceof AliasDeclaration) {
      return $php;
    }
    if ($node instanceof FunctionDeclaration) {

      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }
    if ($node instanceof FunctionDeclarationHeader) {
      $args = $node->getParameterList();

      if (!\is_null($args)) {
        $last_token = $args->getLastToken();
        if ($last_token instanceof CommaToken) {
          $node = $node->removeWhere(($n, $v) ==> $last_token === $n);
        }
      }

      $node = $node->removeWhere(
        ($n, $v) ==>
          $n instanceof SimpleTypeSpecifier || $n instanceof ColonToken,
      );
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }
    if (
      $node instanceof PropertyDeclaration || $node instanceof ConstDeclaration
    ) {
      $node = $node->removeWhere(
        ($n, $v) ==>
          $n instanceof SimpleTypeSpecifier || $n instanceof ColonToken,
      );
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }
    if ($node instanceof ClassishDeclaration) {
      // $node->getTypeParameters();
      // $node = $node->removeWhere(
      //   ($n, $v) ==>
      //     // ($n instanceof SimpleTypeSpecifier && ! ($n instanceof ConstructToken)) || $n instanceof ColonToken,
      //     $n instanceof SimpleTypeSpecifier || $n instanceof ColonToken,
      // );
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }
    if ($node instanceof MethodishDeclaration) {
      $header = $node->getFunctionDeclHeader();
      // $node->getTypeParameters();
      // $node = $node->removeWhere(
      //   ($n, $v) ==>
      //     // ($n instanceof SimpleTypeSpecifier && ! ($n instanceof ConstructToken)) || $n instanceof ColonToken,
      //     $n instanceof SimpleTypeSpecifier || $n instanceof ColonToken,
      // );
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }

    if ($node instanceof ListItem) {
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }
    if ($node instanceof ParameterDeclaration) {
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }


    if ($node instanceof EnumDeclaration) {
      $childs = $node->getChildren();
      $enum_keyword = $childs['keyword'];
      $enum_name = $childs['name']->getCode();

      $code =
        "final class $enum_name {\nprivate function __construct() {}\n$P"; //open enum {...
      $php = $this->sprinft($php, $code);
      $next_node = $childs['enumerators'];
      $parents[] = $node;
      $php = $this->transpile($next_node, $parents, $php);
      $php = $this->sprinft($php, "}\n$P"); //close enum ...} 
      return $php;
    }
    if ($node instanceof Enumerator) {
      $childs = $node->getChildren();
      $enumerator_name = $childs['name']->getCode();
      $enumerator_value = $childs['value']->getCode();

      $code = "const $enumerator_name = $enumerator_value;\n$P";
      $php = $this->sprinft($php, $code);
      return $php;
    }

    if ($node instanceof IfStatement) {
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }
    if ($node instanceof PrefixUnaryExpression) {
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }
    if ($node instanceof ReturnStatement) {
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }
    if ($node instanceof ElseClause) {
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }
    if ($node instanceof ObjectCreationExpression) {
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }
    if ($node instanceof ConstructorCall) {

      // $type = $node->getType()->getCode();
      // $childs = $node->getChildren();
      // $php = $this->sprinft($php, "$type$P");
      // $parents[] = $node;
      // foreach ($childs as $key => $next_node) {
      //   if ($key !== "type")
      //     $php = $this->transpile($next_node, $parents, $php);
      // }

      $args = $node->getArgumentList();
      if (!\is_null($args)) {
        $last_token = $args->getLastToken();
        if ($last_token instanceof CommaToken) {
          $node = $node->removeWhere(($n, $v) ==> $last_token === $n);
        }
      }

      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }

    if ($node instanceof SimpleTypeSpecifier) { //e.g. constructor calls!

      // $type = $node->getType()->getCode();
      // $childs = $node->getChildren();
      // $php = $this->sprinft($php, "$type$P");
      // $parents[] = $node;
      // foreach ($childs as $key => $next_node) {
      //   if ($key !== "type")
      //     $php = $this->transpile($next_node, $parents, $php);
      // }

      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }

    if ($node instanceof ArrayCreationExpression) {
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }
    if ($node instanceof TupleExpression) {
      // $childs = $node->getChildren();
      // $php = $this->sprinft($php, "array$P");
      // $parents[] = $node;
      // foreach ($childs as $key => $next_node) {
      //   if ($key !== "keyword")
      //     $php = $this->transpile($next_node, $parents, $php);
      // }

      $token = $node->getKeyword();
      $array_token =
        new ArrayToken($token->getLeading(), $token->getTrailing());
      $node = $node->replace($token, $array_token);
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }

    if ($node instanceof ParenthesizedExpression) {
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }
    if ($node instanceof SubscriptExpression) {
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }
    if ($node instanceof ConditionalExpression) {
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }
    if (
      $node instanceof AnonymousFunction ||
      $node instanceof AnonymousFunctionUseClause ||
      $node instanceof ElementInitializer ||
      $node instanceof FieldInitializer
    ) {
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }

    if ($node instanceof CollectionLiteralExpression) {
      $childs = $node->getChildren();
      $php = $this->sprinft($php, "\\HH\\Map::hacklib_new$P");
      $parents[] = $node;
      foreach ($childs as $key => $next_node) {
        if ($key !== "name" && $key !== "left_brace" && $key !== "right_brace")
          $php = $this->transpile($next_node, $parents, $php);
        if ($key === "left_brace")
          $php = $this->sprinft($php, "(array($P");
        if ($key === "right_brace")
          $php = $this->sprinft($php, "))$P");

      }

      return $php;
    }

    if ($node instanceof ShapeExpression) {

      $shape_token = $node->getKeyword();
      $array_token =
        new ArrayToken($shape_token->getLeading(), $shape_token->getTrailing());
      $node = $node->replace($shape_token, $array_token);
      $php = $this->interate_children($node, $parents, $php);

      return $php;
    }

    //Token stuff:


    if ($node instanceof EndOfFile) {
      $php = $this->sprinft($php, "");
      return $php;
    }


    if (
      $node instanceof StaticDeclarator ||
      $node instanceof InclusionExpression ||
      $node instanceof InclusionDirective ||
      $node instanceof LiteralExpression ||
      $node instanceof CompoundStatement ||
      $node instanceof BinaryExpression ||
      $node instanceof VariableExpression ||
      $node instanceof ScopeResolutionExpression ||
      $node instanceof ClassishDeclaration ||
      $node instanceof ClassishBody ||
      $node instanceof PropertyDeclarator ||
      $node instanceof SimpleInitializer ||
      $node instanceof ConstDeclaration ||
      $node instanceof ConstantDeclarator ||
      $node instanceof FunctionStaticStatement
    ) {
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }


    //HERE BEGINS VERY GENERAL STUFF

    if ($node instanceof EditableList) {
      $php = $this->interate_children($node, $parents, $php);
      return $php;
    }

    // if ($node instanceof TypeToken) {
    //   return $php;
    // }

    if ($node->isToken()) { //abstraction    
      $token = $node->getCode();

      $php = $this->sprinft($php, "$token$P");

      return $php;
    }

    // $php = $this->interate_children($node, $parents, $php);
    // return $php;


    throw new \Error(
      "Unknown node (".
      $node->getSyntaxKind().
      "): ".
      $node->getCode().
      " \nCurrent PHP: \n$php",
    );
  }


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
    // \var_dump($format);

    // return \sprintf($format, $arg);
    return \str_replace($this->placeholder, $arg, $format);
  }
}
