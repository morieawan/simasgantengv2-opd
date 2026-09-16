declare module 'svelte-spa-router' {
  import { SvelteComponent } from 'svelte';
  
  export default class Router extends SvelteComponent {
    $$prop_def: {
      routes?: Record<string, any>;
      prefix?: string;
      restoreScrollState?: boolean;
    };
  }

  export function push(location: string): Promise<void>;
  export function replace(location: string): Promise<void>;
  export function pop(): Promise<void>;
  export function link(node: HTMLElement): { destroy(): void };
  export const location: any;
  export const querystring: any;
  export const params: any;
}