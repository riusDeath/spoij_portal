public class add
{

	public static  int tong(int a, int b) {
		return a+b;
	}


   public static void main(String args[])
   {
        // for (int i = 0; i < args.length; i++) {
       //      System.out.println(args[i]);
       //  }
      int tong = add.tong(Integer.parseInt(args[0]), Integer.parseInt(args[1]));
      System.out.print(String.valueOf(tong));
   }
   
}
