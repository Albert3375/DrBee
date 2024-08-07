@extends('adminlte::page')

@can('admin')
    <!-- Mostrar elementos de menú para admin -->
@endcan

@can('user')
    <!-- Mostrar elementos de menú para user -->
@endcan
