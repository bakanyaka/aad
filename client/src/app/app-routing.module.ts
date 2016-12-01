import {Routes, RouterModule} from "@angular/router";
import {NoContentComponent} from "./no-content";
import {NgModule} from "@angular/core";


const appROUTES: Routes = [
  //{ path: '',  loadChildren: () => System.import('./+detail/detail.module').then((comp: any) => comp.default) },
  //{ path: '', loadChildren: 'app/layout/layout.module#LayoutModule'},
  { path: '',  loadChildren: () => System.import('./layout/layout.module').then((comp: any) => comp.LayoutModule) },
  { path: '**',    component: NoContentComponent },
];

@NgModule({
  imports: [
    RouterModule.forRoot(appROUTES,{ useHash: false})
  ],
  exports: [
    RouterModule
  ]
})
export class AppRoutingModule {}
