const { registerBlockType } = wp.blocks;

registerBlockType('sportres/gameblock', {
	title: 'Game Block',
   category: 'common',
   icon: 'games',
   description: 'Show result of a game',
   edit: () => {
      return <div>edit !</div> 
   },
   save: () => {
      return <div>save !</div> 
   }
});